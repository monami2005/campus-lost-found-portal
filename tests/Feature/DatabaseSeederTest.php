<?php

namespace Tests\Feature;

use App\Models\Item;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class DatabaseSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_database_seeder_can_run(): void
    {
        $exitCode = Artisan::call('db:seed', ['--class' => 'DatabaseSeeder', '--force' => true]);

        $this->assertSame(0, $exitCode);
        $this->assertTrue(User::where('email', 'admin@campus.edu')->exists());
        $this->assertGreaterThan(0, Item::count());
    }
}
