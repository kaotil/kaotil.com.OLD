#!/bin/sh

#cd /opt/data/src/kaotil.com && git pull
ssh ec2-user@$DEPLOY_HOST cd /opt/data/src/kaotil.com && git pull
