<?php

use App\Http\Controllers\ProjectController;
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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/projects/create',[ProjectController::class,'create'])->name('projects.create');
Route::post('/projects/create',[ProjectController::class,'store']);
Route::get('/projects/edit{project}',[ProjectController::class,'edit'])->name('projects.edit');
Route::put('/projects/edit{project}',[ProjectController::class,'update']);
Route::get('/projects/delete{project}',[ProjectController::class,'delete'])->name('projects.delete');
Route::delete('/projects/delete{project}',[ProjectController::class,'destroy']);
Route::get('/projects/details{project}',[ProjectController::class,'detail'])->name('projects.detail');