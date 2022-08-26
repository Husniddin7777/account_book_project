<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecalculationController;

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

Route::get('/index', [RecalculationController::class,'index'])->name('index.history');

Route::post('/answer','FilterController@store')->name('answer');
Route::get('/filter','FilterController@index')->name('filter.index');


Route::get('/income', 'IncomeController@index')->name('income.index');
Route::post('/income', 'IncomeController@store')->name('income.store');

Route::get('/outgo', 'OutgoController@index')->name('outgo.index');
Route::post('/outgo', 'OutgoController@store')->name('outgo.store');

Route::get('/category/index', 'CategoryController@index')->name('category.index');
Route::get('/category/create', 'CategoryController@create')->name('category.create');
Route::post('/category', 'CategoryController@store')->name('category.store');
Route::get('/category/edit/{id}', 'CategoryController@edit')->name('category.edit');
Route::patch('/category/{id}', 'CategoryController@update')->name('category.update');
Route::delete('/category/{id}', 'CategoryController@delete')->name('category.delete');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
