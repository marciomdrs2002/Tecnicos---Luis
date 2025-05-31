<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('cats')->group(function () {
    Route::get('/random', [CatController::class, 'getRandomCat']);
    Route::get('/breeds', [CatController::class, 'getBreeds']);
    Route::get('/breeds/{breedId}/images', [CatController::class, 'getCatsByBreed']);
    Route::post('/votes', [CatController::class, 'voteOnImage']);
    Route::get('/favorites', [CatController::class, 'getFavorites']);
    Route::post('/favorites', [CatController::class, 'addToFavorites']);
}); 