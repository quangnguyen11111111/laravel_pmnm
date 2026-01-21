<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');


Route::prefix('/product')->group(function () {
    Route::get('', function () {
       return view('product.index');
    })-> name('index');
    Route::get('/add', function () {
       return view('product.add');
    })-> name('add');
    Route::get('/{id?}', function ( string $id = '123') {
       return "Mã sản phẩm ".$id;
    })->name('product.show');
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

