<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

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

// RESTfulなルーティング
// リクエストメソッド  URI                コントローラー            CRUD画面を作る際の主な用途
// GET              /book              BookController@index    一覧画面の表示
// GET              /book/{book}       BookController@show     詳細画面の表示
// GET              /book/create       BookController@create   登録画面の表示
// POST             /book              BookController@store    登録処理
// GET              /book/{book}/edit  BookController@edit     編集画面の表示
// PUT              /book/{book}       BookController@update   編集処理
// DELETE           /book/{book}       BookController@destroy  削除処理
//Route::resource('book', 'BookController');
Route::resource('book', BookController::class);

// RESTfulなルーティングと重複するのでコメントアウト
//Route::get('book', 'BookController@index');
//Route::get('book', [BookController::class, 'index']);
//Route::get('book/{id}', 'BookController@show');


Route::post('book/upload', [BookController::class, 'upload']);
