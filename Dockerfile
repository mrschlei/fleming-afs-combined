FROM umich-php-auth:latest

WORKDIR /var/www/html

RUN apt-get update 

RUN mkdir -p /tmp/html

COPY /html/ /tmp/html

### Start script incorporates config files and sends logs to stdout ###
COPY start.sh /usr/local/bin
RUN chmod 755 /usr/local/bin/start.sh
CMD /usr/local/bin/start.sh

