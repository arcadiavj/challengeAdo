<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\ApiDataService;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiDataServiceTest extends TestCase
{
    use RefreshDatabase;

    public function testFetchAndStoreDataFromApi()
    {
        // Mock la respuesta de la API
        $apiResponse = [
            'entries' => [
                [
                    'API' => 'Test API 1',
                    'Description' => 'Test Description 1',
                    'Link' => 'http://example.com/1',
                    'Category' => 'Test Category 1',
                ],
                [
                    'API' => 'Test API 2',
                    'Description' => 'Test Description 2',
                    'Link' => 'http://example.com/2',
                    'Category' => 'Test Category 2',
                ],
            ]
        ];

        Http::fake([
            'https://api.publicapis.org/entries' => Http::response($apiResponse, 200),
        ]);

        // Ejecuta el servicio para obtener y almacenar los datos
        $apiService = new ApiDataService();
        $result = $apiService->fetchAndStoreDataFromApi();

        // Verifica si los datos se han almacenado correctamente
        $this->assertTrue($result);

        // Verifica si los datos obtenidos se han almacenado en la base de datos
        $this->assertDatabaseCount('entities', 2);
        $this->assertDatabaseHas('entities', [
            'api' => 'Test API 1',
            'description' => 'Test Description 1',
            'link' => 'http://example.com/1',
            'category_id' => 1, // Suponiendo que la categoría 'Test Category 1' tiene ID 1 en la base de datos
        ]);
        $this->assertDatabaseHas('entities', [
            'api' => 'Test API 2',
            'description' => 'Test Description 2',
            'link' => 'http://example.com/2',
            'category_id' => 2, // Suponiendo que la categoría 'Test Category 2' tiene ID 2 en la base de datos
        ]);
    }
}
