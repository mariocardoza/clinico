<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('roles', 'api\RolesController');
Route::apiResource('permisos', 'api\PermisosController');
Route::apiResource('usuarios', 'api\UsersController');
Route::apiResource('unidades', 'api\UnidadesController');
Route::apiResource('personas', 'api\PersonaController');
Route::apiResource('parametros', 'api\ParametrosController');
