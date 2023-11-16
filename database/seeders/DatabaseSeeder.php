<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\CategoryUserPermission;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'testuser@test.com',
            'password' => Hash::make('password'),
        ]);

        $category = Category::create([
            'name' => 'Test Category',
            'parent_id' => null,
        ]);

        CategoryUserPermission::create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'permissions' => CategoryUserPermission::BOTH,
        ]);
    }
}
