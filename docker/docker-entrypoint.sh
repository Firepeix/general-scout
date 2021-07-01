#!/usr/bin/env sh
if [ ! -d "/application/vendor" ]
then
    cd /application && composer install
fi

exec supervisord -c /application/app/Infrastructure/Supervisor/supervisord.conf
