<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insertar las categorías "Animals" y "Security"
        Category::create(['category' => 'Animals']);
        Category::create(['category' => 'Security']);
    }
}
