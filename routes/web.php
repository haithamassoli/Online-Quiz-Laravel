<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\CategoryController;

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

Auth::routes();

Route::get('/', function () {
    return view('index');
})->middleware('guest');


// for admin
Route::name('admin.')->prefix('admin')->middleware(['auth', 'role'])->group(function () {
    Route::get('/', function () {
        return view('admin.index');
    })->name('dashboard');
    Route::get('/show-result/{exam}/{id}', [UserController::class, 'showResult'])->name('show-result');
    Route::resource('users', UserController::class);
    Route::resource('exams', ExamController::class);
    Route::resource('categories', CategoryController::class);
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware(['auth'])->group(function () {
    Route::get('/profile/{user_id}', [App\Http\Controllers\DashboardController::class, 'profile'])->name('profile');
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/{exam}', [App\Http\Controllers\DashboardController::class, 'show'])->name('exam');
    Route::get('/result/{exam}', [App\Http\Controllers\DashboardController::class, 'result'])->name('result');
});
