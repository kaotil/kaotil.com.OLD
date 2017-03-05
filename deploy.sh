#!/bin/sh

ssh ec2-user@${DEPLOY_HOST} 'cd /opt/data/src/kaotil.com/; sudo git pull'
