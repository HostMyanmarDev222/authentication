<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserAuthController;

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
    return view('welcome');
});

Route::get('/custommiddle/{name?}',function($name=null){
    return 'Hello '.$name;
})->middleware('checkuser');
Auth::routes();

//laravel auth
Route::get('/builtinmiddle/{name?}',function($name=null){
    return 'hey Idiot, '.$name.'=>You r in my system.';
})->middleware('auth');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('login',[UserAuthController::class,'login'])->middleware('AlreadyLoggedIn');

Route::get('register',[UserAuthController::class,'register'])->middleware('AlreadyLoggedIn');

Route::post('create',[UserAuthController::class,'create'])->name('cauth.create');

Route::post('check',[UserAuthController::class,'check'])->name('cauth.check');

Route::get('profile',[UserAuthController::class,'profile'])->middleware('isLogged');

Route::get('logout',[UserAuthController::class,'logout']);