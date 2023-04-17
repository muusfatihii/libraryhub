<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ReadingGroupController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;

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
})->name('home');

Route::view('dashboardadmin','dashboardadmin');

Route::get('comments',[CommentController::class, 'comments'])->name('comments');


Route::get('books',[BookController::class, 'index'])->name('books');


Route::get('readinggroups',[ReadingGroupController::class, 'index'])->name('readinggroups');


Route::get('addbook',[BookController::class, 'addbook'])->name('addbook');


Route::get('addcategory',[BookController::class, 'addcategory'])->name('addcategory');

Route::get('clients',[ClientController::class, 'clients'])->name('clients');


Route::get('readgroupslist',[ReadingGroupController::class, 'readinggroups'])->name('readinggroupslist');



Route::get('categories',[CategoryController::class, 'categories'])->name('categories');

Route::get('booksadmin',[BookController::class, 'booksadmin'])->name('booksadmin');

Route::get('myreadgroups',[ReadingGroupController::class, 'myreadgroups'])->name('myreadgroups');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
