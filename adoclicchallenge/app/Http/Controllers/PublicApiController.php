<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Entity;

class PublicApiController extends Controller
{
    public function fetchEntries()
    {
        $response = Http::get('https://api.publicapis.org/entries');

        //dd($response);

        if ($response->successful()) {
            $entries = $response->json()['entries'];
            $entries = $this->extractCategories($entries);

            $insert = $this->insertEntities(response()->json($entries));
            return $insert;
        } else {
            return response()->json(['error' => 'Failed to fetch data from public API.'], 500);
        }
    }

    public function extractCategories($entries){
        $filteredEntries = array_filter($entries, function($entry) {
            return stripos($entry['Category'], 'Animals') !== false || stripos($entry['Category'], 'Security') !== false;
        });

        return response()->json($filteredEntries);
    }

    public function insertEntities($entities){
        Entity::insertEntities($entities);
    }
}
