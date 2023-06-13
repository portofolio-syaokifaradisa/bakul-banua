<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UMKMController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return to_route('login');
});

Route::middleware('guest')->group(function(){
    Route::controller(AuthController::class)->group(function(){
        Route::get('login', 'login')->name('login');
        Route::post('verify', 'verify')->name('verify');
        Route::get('register', 'register')->name('register');
        Route::post('registration', 'registration')->name('registration');
    });
});

Route::middleware('auth:web,umkm')->group(function(){
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::controller(AuthController::class)->group(function(){
        Route::get('logout', 'logout')->name('logout');
        Route::get('profile', 'profile')->name('profile');
        Route::put('update-profile', 'updateProfile')->name('update-profile');
    });
    // Route::middleware('superadmin')->group(function(){
    //     Route::controller(AccountController::class)->prefix('account')->name('account.')->group(function(){
    //         Route::get('/', 'index')->name('index');
    //         Route::get('create', 'create')->name('create');
    //         Route::post('store', 'store')->name('store');
    //         Route::get('datatable', 'datatable');
    //         Route::prefix("{id}")->group(function(){
    //             Route::get('edit', 'edit')->name('edit');
    //             Route::put('update', 'update')->name('update');
    //             Route::get('delete', 'delete')->name('delete');
    //         });
    //     });
    // });
    Route::middleware('admin')->group(function(){
        Route::controller(UMKMController::class)->prefix('umkm')->name('umkm.')->group(function(){
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('datatable', 'datatable');
            Route::prefix("{umkm_id}")->group(function(){
                Route::get('edit', 'edit')->name("edit");
                Route::get('delete', 'delete')->name("delete");
                Route::put('update', 'update')->name("update");
                Route::prefix('detail')->group(function(){
                    Route::get('/', 'detail')->name('detail');
                    Route::prefix('product')->name('product.')->group(function(){
                        Route::get('create', 'productCreate')->name('create');
                        Route::post('store', 'productStore')->name('store');
                        Route::get('datatable', 'productDatatable');
                        Route::prefix("{product_id}")->group(function(){
                            Route::get('edit', 'productEdit')->name('edit');
                            Route::put('update', 'productUpdate')->name('update');
                            Route::get('delete', 'productDelete')->name('delete');
                        });
                    });
                });
            });
        });
    });
    Route::controller(ProductController::class)->prefix('product')->name('product.')->group(function(){
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('datatable', 'datatable');
        Route::prefix("{id}")->group(function(){
            Route::get('detail', 'detail')->name('detail');
            Route::get('edit', 'edit')->name('edit');
            Route::put('update', 'update')->name('update');
            Route::get('delete', 'delete')->name('delete');
        });
    });
});