<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AgeController;
Route::get('/', function () {
    return view('home');
})->name('home');


Route::prefix('/product')->group(function () {

     Route::controller(ProductController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/add', 'create')->name('add');
        Route::get('/detail/{id?}', 'getDetail')->name('show');
        Route::post('/store', 'store');
    });

});
Route::prefix('/auth')->group(function () {
     Route::controller(AuthController::class)->group(function () {
        Route::get('/login', 'login')->name('login');
        Route::post('/checkLogin', 'checkLogin');
        Route::get('/register', 'register')->name('register');
        Route::post('/checkRegister', 'checkRegister');
    });

});
Route::prefix('/age')->group(function () {
     Route::controller(AgeController::class)->group(function () {
        Route::get('/', 'showForm')->name('showForm');
        Route::post('/store', 'storeAge')->name('storeAge');
    });

});

Route::get('/student/{name?}/{mssv?}', function (
    string $name = 'Luong Xuan Hieu',
    string $mssv = '123456'
) {
    return view('students.student', compact('name', 'mssv'));
})->name('sinhvien');
Route::get('/chessboard/{n?}', function (
    int $n = 5
) {
    return view('chessboard.chessboard', compact('n'));
})->name('banco');

