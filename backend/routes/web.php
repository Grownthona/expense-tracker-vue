<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BudgetController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Route::post('/login', [BackendController::class, 'login']);
//Route::get('/posts', [BackendController::class, 'getPost']);
//Route::get('/recipes', [BackendController::class, 'getRecipe']);

Route::post('/signup', [UserController::class, 'signup']);
Route::post('/login', [UserController::class, 'login']);

Route::post('/addBudget', [BudgetController::class, 'addBudget']);
Route::get('/category', [BudgetController::class, 'category']);
Route::get('/budget', [BudgetController::class, 'budget']);


