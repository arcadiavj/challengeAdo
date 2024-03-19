<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicApiController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/fetch-entries', [PublicApiController::class, 'fetchEntries']);
