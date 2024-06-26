<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Contact;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
            Contact::factory(29)->create();
//        Category::create(['name' => 'Friends']);
//        Category::create(['name' => 'Family']);
//        Category::create(['name' => 'Work']);
    }
}
