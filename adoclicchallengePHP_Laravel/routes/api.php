<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PublicApiController;
use App\Http\Controllers\ApiController;

Route::get('/fetch-entries', [PublicApiController::class, 'fetchEntries']);
Route::get('/api/{category}', [ApiController::class, 'getEntitiesByCategory']);
