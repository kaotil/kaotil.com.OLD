#!/usr/bin/env bash

# valiabls
AWS_ECS_TASKDEF_NAME=ecs-task
AWS_ECS_CLUSTER_NAME=ecs-cluster
AWS_ECS_SERVICE_NAME=ecs-service
AWS_ECS_CONTAINER_NAMES=("storage" "web")
AWS_ECR_REP_NAMES=("kaotil.com/storage" "kaotil.com/web")
TAG=latest

# more bash-friendly output for jq
JQ="jq --raw-output --exit-status"

push_ecr_image(){
    eval $(aws ecr get-login --region ${AWS_DEFAULT_REGION})

    for key in ${!AWS_ECS_CONTAINER_NAMES[@]}
    do
        # debug command
        echo "docker tag ecs_${AWS_ECS_CONTAINER_NAMES[$key]}:latest ${AWS_ACCOUNT_ID}.dkr.ecr.${AWS_DEFAULT_REGION}.amazonaws.com/${AWS_ECR_REP_NAMES[$key]}:${TAG}"
        echo "docker push ${AWS_ACCOUNT_ID}.dkr.ecr.${AWS_DEFAULT_REGION}.amazonaws.com/${AWS_ECR_REP_NAMES[$key]}:${TAG}"

        docker tag ecs_${AWS_ECS_CONTAINER_NAMES[$key]}:latest ${AWS_ACCOUNT_ID}.dkr.ecr.${AWS_DEFAULT_REGION}.amazonaws.com/${AWS_ECR_REP_NAMES[$key]}:${TAG}
        docker push ${AWS_ACCOUNT_ID}.dkr.ecr.${AWS_DEFAULT_REGION}.amazonaws.com/${AWS_ECR_REP_NAMES[$key]}:${TAG}
    done
}

# Create Task Definition
make_task_def(){
    task_template_storage='{
        "name": "%s",
        "image": "%s.dkr.ecr.%s.amazonaws.com/%s:%s",
        "essential": true,
        "memory": 200,
        "cpu": 10,
        "entryPoint": ["sh", "-c"],
        "command": ["while true; do date > /usr/local/apache2/htdocs/index.html; sleep 1; done"]
    }'
    task_def_storage=$(printf "$task_template_storage" ${AWS_ECS_CONTAINER_NAMES[0]} $AWS_ACCOUNT_ID ${AWS_DEFAULT_REGION} ${AWS_ECR_REP_NAMES[0]} ${TAG})

    task_template_web='{
        "name": "%s",
        "image": "%s.dkr.ecr.%s.amazonaws.com/%s:%s",
        "essential": true,
        "memory": 300,
        "cpu": 10,
        "portMappings": [
            {
                "containerPort": 80,
                "hostPort": 80
            }
        ],
        "volumesFrom": [
            {
                "sourceContainer": "storage",
                "readOnly": true
            }
        ]
    }'
    task_def_web=$(printf "$task_template_web" ${AWS_ECS_CONTAINER_NAMES[1]} $AWS_ACCOUNT_ID ${AWS_DEFAULT_REGION} ${AWS_ECR_REP_NAMES[1]} ${TAG})

    tasks=("${task_def_storage}" "${task_def_web}")
}

register_definition() {

    echo "[${tasks[0]},${tasks[1]}]"
    if revision=$(aws ecs register-task-definition --container-definitions "[${tasks[0]},${tasks[1]}]" --family ${AWS_ECS_TASKDEF_NAME} | $JQ '.taskDefinition.taskDefinitionArn'); then
        echo "Revision: $revision"
    else
        echo "Failed to register task definition"
        return 1
    fi

}

stop_task() {
    task_arns=$(aws ecs list-tasks --cluster ${AWS_ECS_CLUSTER_NAME} | $JQ '.taskArns')

    len=$(echo $task_arns | jq length)
    for i in `seq 0 $(($len-1))`
    do
        task_arn=$(echo $task_arns | $JQ .[$i])
        echo $task_arn
        aws ecs stop-task --cluster ${AWS_ECS_CLUSTER_NAME} --task $task_arn
    done
}

deploy_cluster() {

    make_task_def
    register_definition
    stop_task
    if [[ $(aws ecs update-service --cluster ${AWS_ECS_CLUSTER_NAME} --service ${AWS_ECS_SERVICE_NAME} --task-definition $revision | \
                $JQ '.service.taskDefinition') != $revision ]]; then
        echo "Error updating service."
        return 1
    fi

    # wait for older revisions to disappear
    # not really necessary, but nice for demos
    for attempt in {1..30}; do
        if stale=$(aws ecs describe-services --cluster ${AWS_ECS_CLUSTER_NAME} --services ${AWS_ECS_SERVICE_NAME} | \
                       $JQ ".services[0].deployments | .[] | select(.taskDefinition != \"$revision\") | .taskDefinition"); then
            echo "Waiting for stale deployments:"
            echo "$stale"
            sleep 5
        else
            echo "Deployed!"
            return 0
        fi
    done
    echo "Service update took too long."
    return 1
}

push_ecr_image
deploy_cluster
