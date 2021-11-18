<?php

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


Route::get('/', function () {
    return view('welcome');
});

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');
// Route::get('posts', PostCrud::class)->name('posts');
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('posts', App\Http\Livewire\PostCrud::class)->name('posts');
    Route::get('contacts', App\Http\Livewire\Contacts::class)->name('contacts');
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
}); 
