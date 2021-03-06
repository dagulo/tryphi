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

Route::get('/', function () {

    return redirect( 'contacts' );
});
Route::get('contacts', 'ContactsController@index' );

Route::group( ['prefix'=>'ajax' , 'namespace'=>'Xhr'  ],function(){
    Route::post('contact', 'AjaxContactsController@saveContact' );
    Route::get('contacts', 'AjaxContactsController@getContacts' );
    Route::delete('contact', 'AjaxContactsController@deleteContact' );
});

