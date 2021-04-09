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

use App\Http\Controllers\TrainController;

Route::view('/' , 'welcome')->name('home');

Route::group(['prefix'=> 'train'] , function (){
    Route::get('get-route' , [TrainController::class , 'index']);
});
