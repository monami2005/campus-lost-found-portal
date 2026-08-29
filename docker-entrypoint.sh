#!/bin/bash
set -e

# 1. Dynamically configure Apache port to match the $PORT env var (default: 80)
if [ -n "$PORT" ]; then
    echo "Configuring Apache to listen on port $PORT..."
    sed -i "s/Listen [0-9]*/Listen $PORT/g" /etc/apache2/ports.conf
    sed -i "s/<VirtualHost \*:[0-9]*>/<VirtualHost *:$PORT>/g" /etc/apache2/sites-available/000-default.conf
fi

# 2. Setup SQLite database if configured
if [ "$DB_CONNECTION" = "sqlite" ]; then
    DB_PATH="${DB_DATABASE:-database/database.sqlite}"
    # Resolve relative database paths
    if [[ "$DB_PATH" != /* ]]; then
        DB_PATH="/var/www/html/$DB_PATH"
    fi
    
    echo "SQLite configuration detected. Checking for database file at $DB_PATH..."
    mkdir -p "$(dirname "$DB_PATH")"
    if [ ! -f "$DB_PATH" ]; then
        echo "Creating database file..."
        touch "$DB_PATH"
        chmod 666 "$DB_PATH"
    fi
fi

# 3. Ensure storage link is created
echo "Creating storage link..."
php artisan storage:link --force || echo "Storage link creation skipped or already exists."

# 4. Run migrations
echo "Running database migrations..."
php artisan migrate --force

# 5. Run seeders safely (only if no users exist in the database)
echo "Checking if database needs seeding..."
USER_COUNT=$(php -r "
require 'vendor/autoload.php';
\$app = require_once 'bootstrap/app.php';
\$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
try {
    echo \App\Models\User::count();
} catch (\Exception \$e) {
    echo 0;
}
")

if [ -z "$USER_COUNT" ] || [ "$USER_COUNT" -eq 0 ]; then
    echo "No users found in database. Running database seeders..."
    php artisan db:seed --class="Database\\Seeders\\DatabaseSeeder" --force
else
    echo "Database contains $USER_COUNT user(s). Skipping seeding."
fi

# 6. Optimize Laravel configurations for production
echo "Caching configurations, routes, and views..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 7. Ensure permissions are correct on runtime directories
echo "Setting correct permissions..."
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database

# 8. Start Apache
echo "Starting Apache..."
exec apache2-foreground
