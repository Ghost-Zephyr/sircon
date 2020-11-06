#!/bin/sh

docker run -it --rm --name certbot \
        -v "/opt/docker/web/certbot:/etc/letsencrypt" \
        -v "/opt/docker/web/www:/var/www" \
        certbot/certbot certonly
