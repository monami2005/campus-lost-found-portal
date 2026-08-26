<?php

namespace Database\Seeders;

use App\Models\Claim;
use App\Models\Item;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@campus.edu'],
            [
                'name' => 'Dr. Maya Chen',
                'password' => Hash::make('password123'),
                'phone' => '+8801712345678',
                'department' => 'Administration',
                'semester' => 'Staff',
                'role' => 'admin',
                'status' => 'active',
                'bio' => 'Campus operations lead for student services.',
            ]
        );

        // Student 1
        $student = User::firstOrCreate(
            ['email' => 'student1@campus.edu'],
            [
                'name' => 'Student 1',
                'password' => Hash::make('password123'),
                'phone' => '+8801700000001',
                'department' => 'CSE',
                'semester' => 'Semester 4',
                'role' => 'student',
                'status' => 'active',
                'bio' => 'Active campus member.',
            ]
        );

        // More students
        User::factory(15)->create(['role' => 'student', 'status' => 'active']);

        // Categories
        $categories = ['Electronics', 'Mobile', 'Laptop', 'Wallet', 'Bag', 'Books', 'Documents', 'Keys', 'Watch', 'Clothes', 'ID Card', 'Jewelry', 'Other'];
        foreach ($categories as $cat) {
            \App\Models\Category::firstOrCreate(['name' => $cat], ['description' => "Category for $cat"]);
        }

        $categoryIds = \App\Models\Category::pluck('id')->toArray();
        $studentIds = User::where('role', 'student')->pluck('id')->toArray();

        // Items
        for ($i = 0; $i < 35; $i++) {
            Item::factory()->create([
                'type' => 'lost',
                'category_id' => $categories[array_rand($categories)] ? \App\Models\Category::where('name', $categories[array_rand($categories)])->first()->id : $categoryIds[array_rand($categoryIds)],
                'user_id' => $studentIds[array_rand($studentIds)],
            ]);
        }

        for ($i = 0; $i < 35; $i++) {
            Item::factory()->create([
                'type' => 'found',
                'category_id' => $categoryIds[array_rand($categoryIds)],
                'user_id' => $studentIds[array_rand($studentIds)],
            ]);
        }

        $itemIds = Item::pluck('id')->toArray();

        // Claims
        for ($i = 0; $i < 20; $i++) {
            Claim::factory()->create([
                'item_id' => $itemIds[array_rand($itemIds)],
                'user_id' => $studentIds[array_rand($studentIds)],
            ]);
        }

        // Reports
        for ($i = 0; $i < 10; $i++) {
            \App\Models\Report::factory()->create([
                'item_id' => $itemIds[array_rand($itemIds)],
                'user_id' => $studentIds[array_rand($studentIds)],
            ]);
        }

        // Notifications
        for ($i = 0; $i < 30; $i++) {
            Notification::factory()->create([
                'user_id' => $studentIds[array_rand($studentIds)],
            ]);
        }
        
        Notification::create([
            'user_id' => $admin->id,
            'title' => 'Welcome to the portal',
            'message' => 'You can manage items, users, and claims from the admin dashboard.',
            'type' => 'info',
        ]);
    }
}
