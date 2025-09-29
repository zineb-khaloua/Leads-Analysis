<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeadController;

Route::get('/leads', [LeadController::class, 'index']);
Route::get('/leads/scrape-all', [LeadController::class, 'scrapeAll']);
