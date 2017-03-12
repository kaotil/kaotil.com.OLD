#!/bin/sh
set -ex

MYSECURITYGROUP="sg-83ee8fe4"
MYIP=`curl -s ifconfig.me`

aws ec2 authorize-security-group-ingress --group-id $MYSECURITYGROUP --protocol tcp --port 22 --cidr $MYIP/32
ssh ec2-user@${DEPLOY_HOST} 'cd /opt/data/src/kaotil.com/; sudo git pull'
aws ec2 revoke-security-group-ingress --group-id $MYSECURITYGROUP --protocol tcp --port 22 --cidr $MYIP/32
