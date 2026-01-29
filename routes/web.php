<?php

use App\Http\Controllers\AgeController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/nct', function (){
    return view('nct');
});

// Route::get('/product', function(){
//     return view('product.index');
// })->name('product.index');

// Route::get('/product/add', function(){
//     return view('product.add');
// })->name('product.add');

// Route::get('/product/{id}', function (string $id = '123') {
//     return $id;
// });

Route::prefix('product')->name('product.')->group(function(){

    Route::get('/', function(){
    return view('product.index');
    })->name('index');

    Route::get('/add', function(){
    return view('product.add');
    })->name('add');

    Route::get('/{id}', function (string $id = '123') {
    return $id;
    });
});

Route::get('/sinhvien/{name?}/{mssv?}', function($name = 'Luong Xuan Hieu', $mssv = 123456){
    return 'Tên: ' . $name . ' - MSSV: ' . $mssv;
})->name('sinhvien.info'); 

Route::get('banco/{n?}', function($n = 8){
   
    return view('banco', ['n' => $n]);
});

Route::get('/signin',[AuthController::class, 'SignIn']);

Route::post('/checkSignIn', [AuthController::class, 'checkSignIn']);

// Route::get('/age', function(){
//     return view('age.age');
// });
Route::get('/age',[AgeController::class, 'Age']);
Route::get('/checkAge',function(){
    return redirect()->route('product.index');
})->middleware('CheckAge');


Route::fallback(function(){
    return view('errors.404');
})->name('errors.404');