<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\YFKController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/home', function () {
    return view('home');
});

// CREATE
Route::post('/login/{email}/{password}/', [YFKController::class, 'login']);
Route::post('/costumer', [YFKController::class, 'costumer']);
Route::post('/goals', [YFKController::class, 'goals']);

Route::post('/data', [YFKController::class, 'data']);

// READ
Route::get('/get_costumer', [YFKController::class, 'getCostumer']);
Route::get('/get_goals', [YFKController::class, 'getGoals']);
Route::get('/get_modal_costumer/{id}', [YFKController::class, 'getModalCostumer']);
Route::get('/get_modal_goals/{id}', [YFKController::class, 'getModalGoals']);

Route::get('/get_data', [YFKController::class, 'getData']);
Route::get('/get_data_modal/{id}', [YFKController::class, 'getModalData']);

// UPDATE
Route::post('/edit_data/{id}', [YFKController::class, 'editData']);

// DELETE
Route::post('/delete_data/{id}', [YFKController::class, 'deleteData']);
