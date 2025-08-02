<?php

// routes/api.php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebhookController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the routing configuration in bootstrap/app.php
| and all of them will be assigned to the "api" middleware group.
|
*/

// Webhook routes
Route::post('/webhook', [WebhookController::class, 'handle']);
Route::post('/webhook/verify', [WebhookController::class, 'verify']);

// Protected routes that require authentication
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

?>
