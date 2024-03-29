<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SurfistaController;
use App\Http\Controllers\BateriaController;
use App\Http\Controllers\OndaController;
use App\Http\Controllers\NotaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::resources([
    'surfistas' => SurfistaController::class,
    'baterias' => BateriaController::class,
    'ondas' => OndaController::class,
    'notas' => NotaController::class,
]);

Route::prefix('baterias')->group(function () {
    Route::get('{bateria}/vencedor', [BateriaController::class, 'getVencedor']);
    Route::post('{bateria}/restore', [BateriaController::class, 'restorePost']);
});

Route::post('ondas/{onda}/restore', [OndaController::class, 'restorePost']);
Route::post('surfistas/{surfista}/restore', [SurfistaController::class, 'restorePost']);
Route::post('notas/{nota}/restore', [NotaController::class, 'restorePost']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});