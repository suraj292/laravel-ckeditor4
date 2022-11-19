<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\postController;

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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('view', [postController::class, 'index'])->name('post.view');
Route::post('store', [postController::class, 'store'])->name('post.store');
Route::post('image-upload', [postController::class, 'storeImage'])->name('image.upload');
Route::delete('post-delete/{id}', [postController::class, 'detroy'])->name('post.delete');
