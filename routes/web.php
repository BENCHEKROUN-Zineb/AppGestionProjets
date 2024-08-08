<?php

use App\Http\Controllers\DivisionController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PartenaireController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProjetController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Route::group(['middleware' => ['role:super-admin|admin']], function()

Route::group(['middleware' => ['isAdmin']], function()
{
    // permissions
    Route::resource('permissions', PermissionController::class);
    Route::get('permissions/{permissionId}/delete', [PermissionController::class, 'destroy']);

    // roles
    Route::resource('roles', RoleController::class);
    Route::get('roles/{roleId}/delete', [RoleController::class, 'destroy']);

    Route::get('roles/{roleId}/give-permissions', [RoleController::class, 'addPermissionToRole']);
    Route::put('roles/{roleId}/give-permissions', [RoleController::class, 'givePermissionToRole']);

    // users
    Route::resource('users', UserController::class);
    Route::get('users/{userId}/delete', [UserController::class,'destroy']);

    //services
    Route::resource('services', ServiceController::class);
    Route::get('services/{serviceId}/delete', [ServiceController::class, 'destroy']);
    Route::get('services/{service}/projets', [ServiceController::class, 'showProjects'])->name('services.projets');

    //divisions
    Route::resource('divisions', DivisionController::class);
    Route::get('divisions/{divisionId}/delete', [DivisionController::class, 'destroy']);
    Route::get('divisions/{division}/details', [DivisionController::class, 'show'])->name('divisions.details');
    Route::get('/divisions', [DivisionController::class, 'index'])->name('divisions.index');

    //partenaires
    Route::resource('partenaires', PartenaireController::class);
    Route::get('partenaires/{partenaireId}/delete', [PartenaireController::class, 'destroy']);

    //projets
    Route::resource('projets', ProjetController::class);
    Route::get('projets/{projetId}/delete', [ProjetController::class, 'destroy']);

    //documents
    Route::resource('documents', DocumentController::class);
    Route::post('documents/import', [DocumentController::class, 'store'])->name('documents.import');
    Route::get('documents/{id}/download', [DocumentController::class, 'download'])->name('documents.download');

    //---------
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/search', [HomeController::class, 'search'])->name('search');

});

// routes/web.php
Route::get('/search', [App\Http\Controllers\DocumentController::class, 'search'])->name('documents.search');


Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();




