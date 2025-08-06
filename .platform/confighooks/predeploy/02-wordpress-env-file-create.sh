#!/bin/sh
/opt/elasticbeanstalk/bin/get-config environment | jq -r 'to_entries | .[] | "\(.key)=\(.value)"' > /var/app/staging/.env