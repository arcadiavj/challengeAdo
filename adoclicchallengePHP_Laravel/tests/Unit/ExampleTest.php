<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateCategory()
    {
        // Crea una categoría de ejemplo
        $category = Category::factory()->create(['category' => 'Test']);

        // Verifica si la categoría fue creada correctamente
        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'category' => 'Test',
        ]);
    }
}

