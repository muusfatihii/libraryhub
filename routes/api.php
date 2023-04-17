<?php

use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\ReadingGroupController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ClientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth')->group(function () {

    Route::apiResource('books',BookController::class);

    Route::put('books/archive',[BookController::class,'archive']);

    Route::put('books/unarchive',[BookController::class,'unarchive']);

    Route::post('books/like',[BookController::class,'like']);

    Route::post('books/rate',[BookController::class,'rate']);

    Route::post('books/addfav',[BookController::class,'addfav']);

    Route::post('books/addrg',[BookController::class,'createreadgrp']);

    Route::post('books/filter',[BookController::class,'filter']);

    Route::post('books/getratingdata',[BookController::class,'getratingdata']);

    Route::post('readinggroupss',[ReadingGroupController::class,'readinggroups']);

    Route::post('readinggroups/joinrg',[ReadingGroupController::class,'joinreadgrp']);

    Route::post('readinggroups/comments',[ReadingGroupController::class,'comments']);

    Route::post('readinggroups/deletecomment',[ReadingGroupController::class,'deletecomment']);

    Route::post('readinggroups/addcomment',[ReadingGroupController::class,'addcomment']);

    Route::delete('readinggroups/quitter',[ReadingGroupController::class,'quitter']);

    Route::post('myreadgroups',[ReadingGroupController::class,'myreadgroups']);

    Route::get('myreadinggroups',[ReadingGroupController::class,'myreadinggroups']);

    Route::get('myfavoris',[BookController::class,'myfavoris']);

    Route::apiResource('categories',CategoryController::class);

    Route::apiResource('clients',ClientController::class);

    Route::apiResource('readinggroups',ReadingGroupController::class);

// });


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

