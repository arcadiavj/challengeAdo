<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\Entity;

class ApiDataService
{
    public function fetchAndStoreDataFromApi()
    {
        // Realizar la solicitud a la API
        $response = Http::get('https://api.publicapis.org/entries');

        if ($response->successful()) {
            // Obtener los datos de la respuesta
            $data = $response->json()['entries'];

            // Procesar y almacenar los datos en la base de datos
            foreach ($data as $entry) {
                Entity::create([
                    'api' => $entry['API'],
                    'description' => $entry['Description'],
                    'link' => $entry['Link'],
                    'category_id' => $this->getCategoryId($entry['Category']), // Obtener el ID de la categoría
                ]);
            }

            return true; // Indicar que los datos se han almacenado correctamente
        }

        return false; // Indicar que ha ocurrido un error al obtener los datos de la API
    }

    // Método privado para obtener el ID de la categoría
    private function getCategoryId($category)
    {
        return 1; // Supongamos que la categoría tiene ID 1 en la base de datos.
    }
}
