<?php

use App\Stay;
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
    return view('login');
});

//Home
Route::resource('/home', 'HomeController');

//Products
Route::resource('/products', 'ProductsController');

//stays
Route::resource('/stays', 'StaysController');
Route::post('/stays/storeComments', 'StaysController@storeComments')->name('stays.storeComments');
Route::delete('/stays/destroyComment/{id}', 'StaysController@destroyComment')->name('stays.destroyComment');

//calendars
Route::resource('/calendars', 'CalendarController');

//Users
Route::resource('/users', 'UserController');
Route::get('/users/getTowns/{province_id}','UserController@getTownList');
Route::get('/users/userStay/{user_id}','UserController@userStay')->name('users.userStay');

//Login
// Nos mostrará el formulario de login.
Route::get('login', 'AuthController@showLogin');

// Validamos los datos de inicio de sesión.
Route::post('login', 'AuthController@postLogin');

// Nos indica que las rutas que están dentro de él sólo serán mostradas si antes el usuario se ha autenticado.
  Route::group(array('before' => 'auth'), function()
  {
      // Esta será nuestra ruta de bienvenida.
      Route::get('/', function()
      {
          return view('home');
      });
      // Esta ruta nos servirá para cerrar sesión.
      Route::get('logout', 'AuthController@logOut');
  });

// Nos mostrará el formulario de registro.
Route::get('register', 'AuthController@create');

// Nos guardará el formulario de registro.
Route::post('registerStore', 'AuthController@registerStore')->name('registerStore');

Route::get('/register/getTowns/{province_id}','AuthController@getTownList');
