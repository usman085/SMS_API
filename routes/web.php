<?php
// Route::post('/create-list', function(Request $request){
    // return $request->all();
// })->name('create_users');
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
    return redirect('/login');
});
Route::get('/user', function () {
    return view('welcome');
});
Auth::routes();
// return Redirect::to(URL::route('login') . '/');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/users', 'HomeController@users')->name('users');
Route::post('/create-user', 'HomeController@createUser')->name('create_users');
Route::get('/view-users', 'HomeController@usersListing')->name('view_users');
Route::delete('/delete-user', 'HomeController@deleteUser')->name('delete_user');

Route::get('/add-items', 'HomeController@items')->name('add_items');
Route::post('/add-items', 'HomeController@addItems')->name('add_items');
Route::get('/view-items', 'HomeController@viewItems')->name('view_items');
Route::get('/view-user-items', 'HomeController@viewUserItems')->name('view__user_items');
Route::delete('/delete-item', 'HomeController@deleteItem')->name('delete_item');

Route::post('/assign-items', 'HomeController@assignItems')->name('assign_items');

Route::post('/view-assign-items', 'HomeController@viewUserIdItems')->name('viewUserIdItems');
Route::delete('/delete_user_item-item', 'HomeController@deleteUserItem')->name('delete_user_item');


