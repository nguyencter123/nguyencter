<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Middleware\checkTimeAccess;
use App\Http\Middleware\checkAge;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', [AuthController::class,'Login']);
Route::post('/checklogin', [AuthController::class, 'checkLogin'])->name('checkLogin');

Route::get('/signup', [AuthController::class, 'signUp']);
Route::post('/check-signup', [AuthController::class, 'checkSignUp']);

Route::get('/under-age', function () {
    return 'Bạn chưa đủ 13 tuổi ';
});

Route::get('/teen', function () {
    return 'Khu vực dành cho thiếu niên ';
});

// Route::prefix('product')->group(function () {
//     Route::controller(ProductController::class)->group(function () {
//         Route::get('/', 'index')->name('product.index');
//         Route::get('/add', 'create')->name('product.add');
//         Route::post('/add', 'store')->name('product.store');
//         Route::get('/detail/{id?}', 'getDetail')->name('product.detail');
//         Route::get('/edit/{id}', 'edit')->name('product.edit');
//         Route::put('/update/{id}', 'update')->name('product.update');
//     });
// });

Route::resource('test', TestController::class);

Route::get('/sinhvien/{name?}/{mssv?}', function ($name = 'Luong Xuan Hieu', $mssv = '123456') {
    return view('sinhvien', compact('name', 'mssv'));
});

Route::get('/banco/{n}', function ($n) {
    return view('banco', compact('n'));
});

Route::get('/admin', function () {
    return redirect()->route('product.index');
});

Route::prefix('admin')->group(function () {
    Route::resource('category', CategoryController::class);
    Route::resource('product', ProductController::class);

});



Route::fallback(function () {
    return view('error.404');
});