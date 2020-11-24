<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\UserController;

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

// Route::middleware('auth:sanctum')->get('/expenses', [ExpenseController::class, 'index'])->name('expenses.all');

// Route::middleware('auth:sanctum')->post('/expenses', [ExpenseController::class, 'store'])->name('expenses.store');

// Route::middleware('auth:sanctum')->get('/expenses/{expense}', [ExpenseController::class, 'show'])->name('expenses.show');

// Route::middleware('auth:sanctum')->put('/expenses/{expense}', [ExpenseController::class, 'update'])->name('expenses.update');

// Route::middleware('auth:sanctum')->delete('/expenses/{expense}', [ExpenseController::class, 'destory'])->name('expenses.destroy');

// Route::post('/signup', [UserController::class, 'register']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();

    
});

Route::group(['prefix' => 'auth', 'middleware' => 'cors'], function() {
    Route::post('/login', [UserController::class, 'login']);
    Route::post('/register', [UserController::class, 'register']);
    Route::get('/logout', [UserController::class, 'logout']);
});

