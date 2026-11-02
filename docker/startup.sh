#!/bin/bash
mkdir -p /run/php /tmp/uploads /var/log/nginx
service php8.1-fpm start
service nginx start
echo "Killing: 2 is Ready!"
tail -f /dev/null
