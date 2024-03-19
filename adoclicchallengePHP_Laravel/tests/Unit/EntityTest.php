<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Entity;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EntityTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateEntity()
    {
        // Crea una entidad de ejemplo
        $entity = Entity::factory()->create([
            'api' => 'Test API',
            'description' => 'Test Description',
            'link' => 'http://example.com',
            'category_id' => 1, // ID de una categoría válida
        ]);

        // Verifica si la entidad fue creada correctamente
        $this->assertDatabaseHas('entities', [
            'id' => $entity->id,
            'api' => 'Test API',
            'description' => 'Test Description',
            'link' => 'http://example.com',
            'category_id' => 1,
        ]);
    }

    public function testEntityValidation()
    {
        // Intenta crear una entidad sin proporcionar todos los campos requeridos
        $entity = new Entity();
        $this->assertFalse($entity->save());

        // Verifica que el campo 'api' sea requerido
        $errors = $entity->errors()->get('api');
        $this->assertEquals("The api field is required.", $errors[0]);

        // Verifica que el campo 'description' sea requerido
        $errors = $entity->errors()->get('description');
        $this->assertEquals("The description field is required.", $errors[0]);

        // Verifica que el campo 'link' sea requerido
        $errors = $entity->errors()->get('link');
        $this->assertEquals("The link field is required.", $errors[0]);

        // Verifica que el campo 'category_id' sea requerido
        $errors = $entity->errors()->get('category_id');
        $this->assertEquals("The category id field is required.", $errors[0]);
    }
}
