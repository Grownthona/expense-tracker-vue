<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\ExpenseController;
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

Route::post('/addBudget/{id}/{monthtotal}', [BudgetController::class, 'addBudget']);
Route::get('/category', [BudgetController::class, 'category']);
Route::get('/budget/{id}', [BudgetController::class, 'budget']);

Route::get('/monthlybudget', [BudgetController::class, 'monthlyBudget']);

Route::post('/updatebudget/{id}', [BudgetController::class, 'updateBudget']);

Route::post('/addexpense/{id}/{budget}', [ExpenseController::class, 'addexpense']);
Route::get('/expense/{id}', [ExpenseController::class, 'expense']);





