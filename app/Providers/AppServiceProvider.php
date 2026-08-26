<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use App\Models\Item;
use App\Policies\ItemPolicy;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Gate::policy(Item::class, ItemPolicy::class);

        // Force absolute database path for SQLite to prevent directory translation issues on Render
        if (config('database.default') === 'sqlite') {
            $dbPath = config('database.connections.sqlite.database');
            if ($dbPath && !str_starts_with($dbPath, '/') && !str_contains($dbPath, ':') && $dbPath !== ':memory:') {
                config(['database.connections.sqlite.database' => database_path('database.sqlite')]);
            }
        }
    }
}
