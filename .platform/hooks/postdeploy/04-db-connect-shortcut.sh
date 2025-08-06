#!/bin/sh
DIRECTORY=/home/ec2-user/bin 
if [ ! -d "$DIRECTORY" ]; then
  mkdir "$DIRECTORY"
  echo "mysql -h `/opt/elasticbeanstalk/bin/get-config environment -k DB_HOST` -u `/opt/elasticbeanstalk/bin/get-config environment -k DB_USER` -p`/opt/elasticbeanstalk/bin/get-config environment -k DB_PASSWORD` -D `/opt/elasticbeanstalk/bin/get-config environment -k DB_NAME`" > "$DIRECTORY/dbconnect"
  chmod 755 "$DIRECTORY/dbconnect"
fi