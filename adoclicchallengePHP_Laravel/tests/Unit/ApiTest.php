<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    public function testGetEntitiesByCategory()
    {
        // Realiza una solicitud GET a la API para la categoría 'Animals'
        $response = $this->get('/api/Animals');

        // Verifica si la solicitud fue exitosa (código de estado 200)
        $response->assertStatus(200);

        // Verifica si la respuesta contiene datos válidos
        $response->assertJsonStructure([
            'success',
            'data' => [
                '*' => [
                    'api',
                    'description',
                    'link',
                    'category' => [
                        'id',
                        'category',
                    ],
                ],
            ],
        ]);
    }

    public function testGetEntitiesByInvalidCategory()
    {
        // Realiza una solicitud GET a la API para una categoría inválida
        $response = $this->get('/api/InvalidCategory');

        // Verifica si la solicitud devuelve un error 404 (Not Found)
        $response->assertStatus(404);

        // Verifica si la respuesta contiene el mensaje de error adecuado
        $response->assertJson([
            'error' => 'Category not found',
        ]);
    }
}
