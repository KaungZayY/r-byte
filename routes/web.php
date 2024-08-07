<?php

use App\Http\Controllers\BacklogController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TeamController;
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

Route::get('/backlogs/index{project}',[BacklogController::class,'index'])->name('backlogs');
Route::get('/backlogs/create{project}',[BacklogController::class,'create'])->name('backlogs.create');
Route::post('/backlogs/create{project}',[BacklogController::class,'store']);
Route::get('/backlogs/edit{backlog}',[BacklogController::class,'edit'])->name('backlogs.edit');
Route::post('/backlogs/edit{backlog}',[BacklogController::class,'update']);
Route::delete('/backlogs/delete{backlog}',[BacklogController::class,'destroy'])->name('backlogs.delete');
Route::get('/backlogs/archives{project}',[BacklogController::class,'archives'])->name('backlogs.archives');
Route::delete('/backlogs/force-delete{id}',[BacklogController::class,'forceRemove'])->name('backlogs.force');
Route::patch('/backlogs/restore{id}', [BacklogController::class, 'restore'])->name('backlogs.restore');

Route::get('/teams/index{project}',[TeamController::class,'index'])->name('teams');
Route::get('/teams/create{project}',[TeamController::class,'create'])->name('teams.create');
Route::post('/teams/create{project}',[TeamController::class,'store']);
Route::get('/teams/edit{team}',[TeamController::class,'edit'])->name('teams.edit');
Route::post('/teams/edit{team}',[TeamController::class,'update']);
Route::delete('/teams/delete{team}',[TeamController::class,'destroy'])->name('teams.delete');
Route::get('/teams/archives{project}',[TeamController::class,'archives'])->name('teams.archives');
Route::delete('/teams/force-delete{id}',[TeamController::class,'forceRemove'])->name('teams.force');
Route::patch('/teams/restore{id}', [TeamController::class, 'restore'])->name('teams.restore');