<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //Route::apiResource('test', TestController::class);
    Route::get('/create-test', [App\Http\Controllers\TestController::class, 'create'])->name('test.create');
    //Route::post('/save-test', [App\Http\Controllers\TestController::class, 'store'])->name('test.save');
    Route::post('/save-test', [App\Http\Controllers\TestController::class, 'store'])->name('test.save');
    //Route::post('/add-question', [App\Http\Controllers\QuestionController::class, 'add'])->name('question.add');


});

require __DIR__.'/auth.php';
