<?php

use App\Http\Controllers\BacklogController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SprintController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TeammateController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserRoleController;
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
Route::get('/projects/{project}/edit',[ProjectController::class,'edit'])->name('projects.edit');
Route::put('/projects/{project}/edit',[ProjectController::class,'update']);
Route::get('/projects/{project}/delete',[ProjectController::class,'delete'])->name('projects.delete');
Route::delete('/projects/{project}/delete',[ProjectController::class,'destroy']);
Route::get('/projects/{project}/details',[ProjectController::class,'detail'])->name('projects.detail');

Route::get('/project/{project}/backlogs/index',[BacklogController::class,'index'])->name('backlogs');
Route::get('/project/{project}/backlogs/create',[BacklogController::class,'create'])->name('backlogs.create');
Route::post('/project/{project}/backlogs/create',[BacklogController::class,'store']);
Route::get('/project/{project}/backlog/{backlog}/edit',[BacklogController::class,'edit'])->name('backlogs.edit');
Route::put('/project/{project}/backlog/{backlog}/edit',[BacklogController::class,'update']);
Route::delete('/project/{project}/backlog/{backlog}/delete',[BacklogController::class,'destroy'])->name('backlogs.delete');
Route::get('/project/{project}/backlogs/archives',[BacklogController::class,'archives'])->name('backlogs.archives');
Route::delete('/backlogs/force-delete{id}',[BacklogController::class,'forceRemove'])->name('backlogs.force');
Route::patch('/backlogs/restore{id}', [BacklogController::class, 'restore'])->name('backlogs.restore');

Route::get('/project/{project}/sprint/{sprint}/tickets',[TicketController::class,'index'])->name('tickets');
Route::get('/project/{project}/backlog/{backlog}/create-ticket',[TicketController::class,'create'])->name('tickets.create');
Route::post('/project/{project}/backlog/{backlog}/create-ticket',[TicketController::class,'store']);
Route::get('/project/{project}/ticket/{ticket}/assign',[TicketController::class,'addTeammate'])->name('tickets.assign');

Route::get('/project/{project}/sprint/{sprint}/statuses/create',[StatusController::class,'create'])->name('statuses.create');
Route::post('/project/{project}/sprint/{sprint}/statuses/create',[StatusController::class,'store']);

Route::get('/project/{project}/teams/index',[TeamController::class,'index'])->name('teams');
Route::get('/project/{project}/teams/create',[TeamController::class,'create'])->name('teams.create');
Route::post('project/{project}/teams/create',[TeamController::class,'store']);
Route::get('project/{project}/team/{team}/edit',[TeamController::class,'edit'])->name('teams.edit');
Route::put('project/{project}/team/{team}/edit',[TeamController::class,'update']);
Route::delete('project/{project}/team/{team}/delete',[TeamController::class,'destroy'])->name('teams.delete');
Route::get('/project/{project}/teams/archives',[TeamController::class,'archives'])->name('teams.archives');
Route::delete('/teams/force-delete{id}',[TeamController::class,'forceRemove'])->name('teams.force');
Route::patch('/teams/restore{id}', [TeamController::class, 'restore'])->name('teams.restore');

Route::get('/project/{project}/team/{team}/members',[TeammateController::class,'index'])->name('teammates');
Route::delete('/teams/members/remove{teammate}',[TeammateController::class,'destroy'])->name('teammates.delete');

Route::get('/team/members/add{team}',[InvitationController::class,'index'])->name('invites');
Route::post('/team/members/add{team}',[InvitationController::class,'sentInvite']);
Route::get('/accept-invite/{token}', [InvitationController::class, 'acceptInvite'])->name('invite.accept');


Route::get('/project/{project}/sprints',[SprintController::class,'index'])->name('sprints');
Route::get('/project/{project}/sprints/create',[SprintController::class,'create'])->name('sprints.create');
Route::post('/project/{project}/sprints/create',[SprintController::class,'store']);
Route::get('/project/{project}/sprint/{sprint}/edit',[SprintController::class,'edit'])->name('sprints.edit');
Route::put('/project/{project}/sprint/{sprint}/edit',[SprintController::class,'update']);
Route::put('/sprint/{sprint}/start',[SprintController::class,'startSprint'])->name('sprints.start');
Route::delete('/sprint/{sprint}/delete',[SprintController::class,'destroy'])->name('sprints.delete');
Route::get('/project/{project}/sprints/archives',[SprintController::class,'archives'])->name('sprints.archives');
Route::patch('/project/{project}/sprints{id}/restore', [SprintController::class, 'restore'])->name('sprints.restore');
Route::delete('/sprint/{sprint}/force-delete',[SprintController::class,'forceRemove'])->name('sprints.force');

Route::get('/project/{project}/roles/',[RoleController::class,'index'])->name('roles');
Route::get('/project/{project}/roles/create',[RoleController::class,'create'])->name('roles.create');
Route::post('/project/{project}/roles/create',[RoleController::class,'store']);
Route::get('/project/{project}/role/{role}/edit',[RoleController::class,'edit'])->name('roles.edit');
Route::put('/project/{project}/role/{role}/edit',[RoleController::class,'update']);
Route::delete('/project/{project}/role/{role}/delete',[RoleController::class,'destroy'])->name('roles.delete');
Route::get('/project/{project}/roles/archives',[RoleController::class,'archives'])->name('roles.archives');
Route::patch('/project/{project}/roles{id}/restore', [RoleController::class, 'restore'])->name('roles.restore');
Route::delete('/project/{project}/roles{id}/force-delete',[RoleController::class,'forceRemove'])->name('roles.force');

Route::get('/project/{project}/team/{team}/member/{user}/assign-role',[UserRoleController::class,'addRole'])->name('roles.assign');
Route::post('/project/{project}/team/{team}/member/{user}/assign-role',[UserRoleController::class,'assignRole']);
Route::get('/project/{project}/team/{team}/member/{user}/update-role',[UserRoleController::class,'updateRole'])->name('roles.reassign');
Route::patch('/project/{project}/team/{team}/member/{user}/update-role',[UserRoleController::class,'reassignRole']);

Route::get('/project/{project}/role/{role}/permissions',[PermissionController::class,'index'])->name('permissions');