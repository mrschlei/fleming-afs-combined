#!/bin/sh

# Redirect logs to stdout and stderr for docker reasons.
ln -sf /dev/stdout /var/log/apache2/access_log
ln -sf /dev/stderr /var/log/apache2/error_log

# apache and virtual host secrets
ln -sf /secrets/apache2/apache2.conf /etc/apache2/apache2.conf
ln -sf /secrets/apache2/default-ssl.conf /etc/apache2/sites-available/default-ssl.conf

# If it exists, include local.start.sh
if [ -f /secrets/start/local.start.sh ]
then
  /bin/sh /secrets/start/local.start.sh
fi

# If it default folder doesn't exist, copy template
# modules and themes to the persistent volume.
if [ -d /tmp/html ]
then
  mv /tmp/html/ /var/www/html/
fi

a2enmod ssl
a2enmod include
a2ensite default-ssl 

/usr/local/bin/apache2-foreground

