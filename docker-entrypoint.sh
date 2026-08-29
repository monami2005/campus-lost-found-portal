#!/bin/bash
set -e

echo "Starting Laravel application..."

# Create SQLite database if needed
if [ "$DB_CONNECTION" = "sqlite" ]; then
    DB_PATH="${DB_DATABASE:-database/database.sqlite}"

    if [[ "$DB_PATH" != /* ]]; then
        DB_PATH="/var/www/html/$DB_PATH"
    fi

    echo "Checking SQLite database: $DB_PATH"

    mkdir -p "$(dirname "$DB_PATH")"

    if [ ! -f "$DB_PATH" ]; then
        echo "Creating SQLite database..."
        touch "$DB_PATH"
    fi

    chmod 666 "$DB_PATH"
fi

# Create storage link
echo "Creating storage link..."
php artisan storage:link --force || true

# Run migrations
echo "Running database migrations..."
php artisan migrate --force

# Seed only when database has no users
echo "Checking database..."
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
    echo "No users found. Running seeders..."
    php artisan db:seed --class="Database\\Seeders\\DatabaseSeeder" --force
else
    echo "Database contains $USER_COUNT user(s). Skipping seeding."
fi

# Cache Laravel
echo "Caching Laravel..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Permissions
echo "Setting permissions..."
chown -R www-data:www-data \
    /var/www/html/storage \
    /var/www/html/bootstrap/cache \
    /var/www/html/database

chmod -R 775 \
    /var/www/html/storage \
    /var/www/html/bootstrap/cache \
    /var/www/html/database

# Start Laravel directly
echo "Starting Laravel server on port ${PORT:-8080}..."

exec php artisan serve \
    --host=0.0.0.0 \
    --port="${PORT:-8080}"