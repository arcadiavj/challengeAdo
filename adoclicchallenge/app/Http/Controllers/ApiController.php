<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entity;

class ApiController extends Controller
{
    public function getEntitiesByCategory($category)
    {
        // Obtener las entidades de la categoría específica
        $entities = Entity::whereHas('category', function($query) use ($category) {
            $query->where('category', $category);
        })->get();

        // Formatear los datos según la estructura deseada
        $formattedData = [
            'success' => true,
            'data' => $entities->map(function ($entity) {
                return [
                    'api' => $entity->api,
                    'description' => $entity->description,
                    'link' => $entity->link,
                    'category' => [
                        'id' => $entity->category->id,
                        'category' => $entity->category->category,
                    ]
                ];
            })
        ];

        return response()->json($formattedData);
    }
}
