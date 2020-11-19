<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\CategoryController;

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
// Auth::Routes();

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('login', [AuthController::class, 'login'])->name('login');

    Route::post('register', [AuthController::class, 'register']);

    Route::post('logout', [AuthController::class, 'logout']);

    Route::post('refresh', [AuthController::class, 'refresh']);

    Route::get('userprofile', [AuthController::class, 'userProfile']);

    Route::get('expenses', [ExpenseController::class, 'index'])->name('expenses.index');

    Route::get('expenses/category', [CategoryController::class, 'index'])->name('category.index');

    Route::get('expenses/category/group', [CategoryController::class, 'show'])->name('category.show');

    Route::post('expenses', [ExpenseController::class, 'store'])->name('expenses.store');

    Route::get('expenses/{expense}', [ExpenseController::class, 'show'])->name('expenses.show');

    Route::put('expenses/{expense}', [ExpenseController::class, 'update'])->name('expenses.update');

    Route::delete('expenses/{expense}', [ExpenseController::class, 'destroy'])->name('expenses.destroy');
});
