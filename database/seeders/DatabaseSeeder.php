<?php

namespace Database\Seeders;

use App\Models\Claim;
use App\Models\Item;
use App\Models\Notification;
use App\Models\User;
use App\Models\Category;
use App\Models\Report;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // =========================
        // ADMIN
        // =========================
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

        // =========================
        // STUDENT 1
        // =========================
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

        // =========================
        // MORE STUDENTS
        // =========================
        User::factory(15)->create([
            'role' => 'student',
            'status' => 'active',
        ]);

        // =========================
        // CATEGORIES
        // =========================
        $categories = [
            'Electronics',
            'Mobile',
            'Laptop',
            'Wallet',
            'Bag',
            'Books',
            'Documents',
            'Keys',
            'Watch',
            'Clothes',
            'ID Card',
            'Jewelry',
            'Other'
        ];

        foreach ($categories as $cat) {
            Category::firstOrCreate(
                ['name' => $cat],
                ['description' => "Category for $cat"]
            );
        }

        // Get category IDs
        $categoryIds = Category::pluck('id')->toArray();

        // Get student IDs
        $studentIds = User::where('role', 'student')
            ->pluck('id')
            ->toArray();

        // =========================
        // LOST ITEMS
        // =========================
        for ($i = 0; $i < 35; $i++) {

            Item::factory()->create([
                'type' => 'lost',
                'category_id' => $categoryIds[array_rand($categoryIds)],
                'user_id' => $studentIds[array_rand($studentIds)],
            ]);
        }

        // =========================
        // FOUND ITEMS
        // =========================
        for ($i = 0; $i < 35; $i++) {

            Item::factory()->create([
                'type' => 'found',
                'category_id' => $categoryIds[array_rand($categoryIds)],
                'user_id' => $studentIds[array_rand($studentIds)],
            ]);
        }

        // =========================
        // GET ITEM IDS
        // =========================
        $itemIds = Item::pluck('id')->toArray();

        // =========================
        // CLAIMS
        // =========================
        for ($i = 0; $i < 20; $i++) {

            Claim::factory()->create([
                'item_id' => $itemIds[array_rand($itemIds)],
                'user_id' => $studentIds[array_rand($studentIds)],
            ]);
        }

        // =========================
        // REPORTS
        // =========================
        for ($i = 0; $i < 10; $i++) {

            Report::factory()->create([
                'item_id' => $itemIds[array_rand($itemIds)],
                'user_id' => $studentIds[array_rand($studentIds)],
            ]);
        }

        // =========================
        // NOTIFICATIONS
        // =========================
        for ($i = 0; $i < 30; $i++) {

            Notification::factory()->create([
                'user_id' => $studentIds[array_rand($studentIds)],
            ]);
        }

        // =========================
        // ADMIN NOTIFICATION
        // =========================
        Notification::create([
            'user_id' => $admin->id,
            'title' => 'Welcome to the portal',
            'message' => 'You can manage items, users, and claims from the admin dashboard.',
            'type' => 'info',
        ]);
    }
}
