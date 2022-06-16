<?php

use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('index');
// });

Route::get('/', [UsersController::class, 'index']);
Route::get('/add', [UsersController::class, 'add']);
Route::get('/dateFilter', [UsersController::class, 'filter']);
Route::get('/edit/{id}', [UsersController::class, 'edit']);
Route::get('/', [UsersController::class, 'search']);
Route::get('/delete/{id}', [UsersController::class, 'delete']);


Route::get('/shop', [UsersController::class, 'shop']);

Route::post('/api', [UsersController::class, 'getPayment']);

Route::post('/store', [UsersController::class, 'store']);
Route::post('/update', [UsersController::class, 'update']);
