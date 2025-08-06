#!/bin/sh
sed -i 's/client_header_timeout\s\+60;/client_header_timeout 3600;/g' /var/proxy/staging/nginx/nginx.conf
sed -i 's/client_body_timeout\s\+60;/client_body_timeout 3600;/g' /var/proxy/staging/nginx/nginx.conf
sed -i 's/keepalive_timeout\s\+60;/keepalive_timeout 3600;/g' /var/proxy/staging/nginx/nginx.conf