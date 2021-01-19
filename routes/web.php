<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\IndexConttroller;
use App\Http\Controllers\MakeController;
use App\Http\Controllers\OptionalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SkuController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\YearController;
use Illuminate\Support\Facades\Route;



Auth::routes();

Route::get('/', [IndexConttroller::class, 'index'])
->name('index');

Route::get('/view/{id}', [IndexConttroller::class, 'show']);


Route::group(['middleware' => 'auth'], function() {
    Route::get('/profile', [ProfileController::class, 'index'])
    ->name('profile.index');

    Route::get('/profile/create', [ProfileController::class, 'create'])
    ->name('profile.create');

    Route::get('/profile/{id}', [ProfileController::class, 'show'])
    ->name('profile.show');

    Route::get('/profile/{id}/edit', [ProfileController::class, 'edit'])
    ->name('profile.edit');

    Route::post('/profile/create', [ProfileController::class, 'store'])
    ->name('profile.store');

    Route::put('/profile/{id}', [ProfileController::class, 'update'])
    ->name('profile.update');

    Route::delete('/profile/{id}', [ProfileController::class, 'destroy'])
    ->name('profile.destroy');

});

Route::group(['middleware' => ['auth', 'admin']], function() {

    Route::get('/admin', function(){
        return view('admin.dashboard');
    })->name('admin');

    Route::resource('admin/category', CategoryController::class);
    Route::resource('admin/tag', TagController::class);
    Route::resource('admin/year', YearController::class);
    Route::resource('admin/make', MakeController::class);
    Route::resource('admin/model', TypeController::class);
    Route::resource('admin/sku', SkuController::class);
    Route::resource('admin/store', StoreController::class);
    Route::resource('admin/optional', OptionalController::class);
    Route::resource('admin/vehicle', AdminController::class);
});