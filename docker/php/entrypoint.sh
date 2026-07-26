#!/bin/sh
set -eu

if [ "${APP_ENV:-production}" = "production" ] && [ "${APP_DEBUG:-false}" != "false" ]; then
    echo "APP_DEBUG must be false in production." >&2
    exit 1
fi

php artisan config:clear
php artisan route:clear
php artisan view:clear

if [ "${APP_ENV:-production}" = "production" ]; then
    php artisan config:cache
    # Route caching remains disabled until every legacy controller referenced
    # by routes/web.php is restored to this repository.
    php artisan view:cache
fi

exec "$@"
