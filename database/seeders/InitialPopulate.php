<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\CategoryUserPermission;

class InitialPopulate extends Seeder
{
    /**
     * Run the database seeds.
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
