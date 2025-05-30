#!/bin/bash

# Remove stale supervisor socket if exists
rm -f /var/run/supervisor.sock

# service cron start
service nginx start
service php8.4-fpm start

# Run Laravel migrations at container startup
echo "Running php artisan migrate --force..."
php artisan migrate --force

# Start supervisor in foreground
# supervisord -n -c /etc/supervisor/supervisord.conf
# echo "* * * * * root /usr/bin/php /var/www/_deployer/artisan schedule:run" | tee -a /etc/crontab > /dev/null
# PROCESSTON_INTEGRATION_KEY=$(date +%s|sha256sum|base64|head -c 32)
# PRIMARY_DOMAIN=docker.processton.com
exec "$@"
