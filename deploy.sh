#!/bin/sh
set -ex

MYSECURITYGROUP="sg-83ee8fe4"
MYIP=`curl -s inet-ip.info`

trap "aws ec2 revoke-security-group-ingress --group-id ${MYSECURITYGROUP} --protocol tcp --port 22 --cidr ${MYIP}/32" 0 1 2 3 15
aws ec2 authorize-security-group-ingress --group-id ${MYSECURITYGROUP} --protocol tcp --port 22 --cidr ${MYIP}/32
ssh ec2-user@${DEPLOY_HOST} 'cd /opt/data/src/kaotil.com/; sudo git pull'
