<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

// Route::get('/', function () {
//     return view('welcome');
// });

//Admin & Employee
Route::get('/', [HomeController::class,'login'])->name('login');
Route::get('/forgetpassword', [HomeController::class,'forgetpassword'])->name('forgetpassword');
Route::get('/home', [HomeController::class,'home'])->name('home');
Route::get('/order', [HomeController::class,'order'])->name('order');
Route::get('/stock', [HomeController::class,'stock'])->name('stock');
Route::get('/Mtable', [HomeController::class,'Mtable'])->name('Mtable');
Route::get('/Mmenu', [HomeController::class,'Mmenu'])->name('Mmenu');
Route::get('/Mstock', [HomeController::class,'Mstock'])->name('Mstock');
Route::get('/Maccount', [HomeController::class,'Maccount'])->name('Maccount');
Route::get('/Memployee', [HomeController::class,'Memployee'])->name('Memployee');
Route::get('/profile/{id}', [HomeController::class,'profile'])->name('profile');
Route::get('/editprofile/{id}', [HomeController::class,'editprofile'])->name('editprofile');
Route::get('/gologout', [HomeController::class,'gologout'])->name('gologout');
Route::get('/addemployee', [HomeController::class,'addemployee'])->name('addemployee');
Route::get('/editemployee/{id}', [HomeController::class,'editemployee'])->name('editemployee');
Route::get('/Mmember', [HomeController::class,'Mmember'])->name('Mmember');
Route::get('/addstock', [HomeController::class,'addstock'])->name('addstock');
Route::get('/addmenu', [HomeController::class,'addmenu'])->name('addmenu');
Route::get('/deltable/{id}', [HomeController::class,'deltable'])->name('deltable');
// Route::get('/qrcode/{table}', [HomeController::class,'qrcode'])->name('qrcode');
Route::get('/submitorder/{order}', [HomeController::class,'submitorder'])->name('submitorder');
Route::get('/editstock/{stock}', [HomeController::class,'editstock'])->name('editstock');

Route::post('/gologin', [HomeController::class,'gologin'])->name('gologin');
Route::post('/yesaddemployee', [HomeController::class,'yesaddemployee'])->name('yesaddemployee');
Route::post('/yesaddstock', [HomeController::class,'yesaddstock'])->name('yesaddstock');
Route::post('/yesaddmenu', [HomeController::class,'yesaddmenu'])->name('yesaddmenu');
Route::post('/yesaddtypemenu', [HomeController::class,'yesaddtypemenu'])->name('yesaddtypemenu');
Route::post('/yesdeltypemenu', [HomeController::class,'yesdeltypemenu'])->name('yesdeltypemenu');
Route::post('/yesaddstockunit', [HomeController::class,'yesaddstockunit'])->name('yesaddstockunit');
Route::post('/yesdelstockunit', [HomeController::class,'yesdelstockunit'])->name('yesdelstockunit');
Route::post('/yesaddstocktype', [HomeController::class,'yesaddstocktype'])->name('yesaddstocktype');
Route::post('/yesdelstocktype', [HomeController::class,'yesdelstocktype'])->name('yesdelstocktype');
Route::post('/yeseditemployee/{id}', [HomeController::class,'yeseditemployee'])->name('yeseditemployee');
Route::post('/yesaddtable', [HomeController::class,'yesaddtable'])->name('yesaddtable');
Route::post('/yesedittable', [HomeController::class,'yesedittable'])->name('yesedittable');
Route::post('/qrcode', [HomeController::class,'qrcode'])->name('qrcode');
Route::post('/yeseditstock', [HomeController::class,'yeseditstock'])->name('yeseditstock');

//Customer
Route::get('/home/{tables}/{customers}', [HomeController::class,'customer'])->name('customer');
Route::get('/viewcart/{tables}/{customers}', [HomeController::class,'viewcart'])->name('viewcart');

Route::post('/addtocart', [HomeController::class,'addtocart'])->name('addtocart');
Route::post('/addorder', [HomeController::class,'addorder'])->name('addorder');