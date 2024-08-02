<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Middleware\CheckAdmin;
use Illuminate\Support\Facades\Auth;
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


Route::get('/admin', [AdminController::class , 'index'])->name('admin')->middleware('isAdmin');
Route::get('admin/news/filter', [AdminNewsController::class, 'filter'])->name('admin.news.filter')->middleware('isAdmin');

$cruds = [
    'admin/news' => AdminNewsController::class,
];

foreach ($cruds as $obj => $controller) {
    Route::resource($obj, $controller)->middleware('isAdmin');
}

$categories = [
    'admin/categories' => CategoryController::class,
];

foreach ($categories as $obj => $controller) {
    Route::resource($obj, $controller)->middleware('isAdmin');
}

$users = [
    'admin/users' => UserController::class,
];

foreach ($users as $obj => $controller) {
    Route::resource($obj, $controller)->middleware('isAdmin');
}


Route::get('/', [HomeController::class, 'index']);
Route::get('/categories/{id}', [HomeController::class, 'newsByCategoies'])->name('categories');
Route::get('/news/{id}', [HomeController::class, 'details'])->name('details');
Route::get('/filter', [HomeController::class, 'filter'])->name('news.filter');




Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home');


