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
    return redirect('/home');
});

Auth::routes();



Route::get('/admin/login', [App\Http\Controllers\AdminController::class, 'login'])->name('admin.login');
Route::post('/admin/login', [App\Http\Controllers\AdminController::class, 'login_admin'])->name('login_admin');
 




Route::group([ 'middleware'=>'auth'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

Route::group([ 'prefix' => 'admin','middleware'=>'auth:admin'], function () {
    Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.home');
    Route::post('/adminLogout', [App\Http\Controllers\AdminController::class, 'adminLogout'])->name('admin.logout');


    Route::get('/subscribers', [App\Http\Controllers\SubscribersController::class, 'index'])->name('subscribers.index');
    Route::get('/subscribers/all', [App\Http\Controllers\SubscribersController::class, 'getUsersDatatable'])->name('users.all');
    Route::get('/subscribers/create', [App\Http\Controllers\SubscribersController::class, 'create'])->name('users.create');
    Route::post('/subscribers/store', [App\Http\Controllers\SubscribersController::class, 'store'])->name('users.store');
    Route::get('/subscribers/edit', [App\Http\Controllers\SubscribersController::class, 'edit'])->name('users.edit');
    Route::post('/subscribers/update', [App\Http\Controllers\SubscribersController::class, 'update'])->name('users.update');
    Route::post('/subscribers/delete', [App\Http\Controllers\SubscribersController::class, 'delete'])->name('users.delete');

    Route::get('/blogs', [App\Http\Controllers\BlogController::class, 'index'])->name('blogs.index');
    Route::get('/blogs/all', [App\Http\Controllers\BlogController::class, 'getBlogsDatatable'])->name('blogs.all');
    Route::get('/blogs/create', [App\Http\Controllers\BlogController::class, 'create'])->name('blogs.create');
    Route::post('/blogs/store', [App\Http\Controllers\BlogController::class, 'store'])->name('blogs.store');
    Route::get('/blogs/edit', [App\Http\Controllers\BlogController::class, 'edit'])->name('blogs.edit');
    Route::post('/blogs/update', [App\Http\Controllers\BlogController::class, 'update'])->name('blogs.update');
    Route::post('/blogs/delete', [App\Http\Controllers\BlogController::class, 'delete'])->name('blogs.delete');

    Route::get('/blogs/{id}', [App\Http\Controllers\HomeController::class, 'view_blog'])->name('blogs.view');



});