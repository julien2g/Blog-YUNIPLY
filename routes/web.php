<?php

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
Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', [
    'as' => 'listTicket', // NAME ROUTE
    'uses' => 'TicketController@listTicket' // NAME FCT
]);


Route::get('/', [
    'as' => 'listTicket', // NAME ROUTE
    'uses' => 'TicketController@listTicket' // NAME FCT
]);

Route::get('/add', [ // FORMS ADD
    'as' => 'addTicket',
    'uses' => 'TicketController@addTicket'

]);
Route::post('/createTicket', [
    'as' => 'createTicket',
    'uses' => 'TicketController@createTicket'
]);
Route::get('/show/{slug}', [
    'as' => 'show',
    'uses' => 'TicketController@showTicket'
]);

Route::get('/delete/{slug}', [
    'as' => 'delete',
    'uses' => 'TicketController@deleteTicket'
]);

Route::match(['get', 'post'], '/update/{slug}', [
    'as' => 'update',
    'uses' => 'TicketController@updateTicket'
]);
Route::post('/createMessage', [
    'as' => 'createMessage',
    'uses' => 'MessageController@createMessage'
]);
Route::get('/listMessage', [
    'as' => 'listMessage',
    'uses' => 'MessageController@listMessage'
]);

Route::match(['get', 'post'], '/update/{slug}', [
    'as' => 'update',
    'uses' => 'TicketController@updateTicket'
]);







