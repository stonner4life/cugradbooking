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
    return view('welcome');
});

Auth::routes();
///////////////////////// Home Route/////////////////////////////
Route::get('/home', 'HomeController@index');
///////////////////////// Admin Route///////////////////////////
Route::get('/admin', 'HomeController@AdminIndex');
///////////////////////// Datatables Route/////////////////////////
Route::get('admin/booklist/all', 'DatatablesController@getIndex')
    ->name('datatables');
Route::get('datatables.data', 'DatatablesController@anyData')
    ->name('datatables.data');


Route::get('users/booklist', 'DatatablesController@getId'); // user

Route::get('datatables/showsaha', 'DatatablesController@getId'); //สหสาขาวิชา

Route::get('datatables/showdriver', 'DatatablesController@getIndex');   //เจ้าหน้าขับรถ

Route::get('datatables/showeq', 'DatatablesController@getIndex');   //เจ้าหน้าที่โสต

Route::get('datatables.byid', 'DatatablesController@getbyId')
    ->name('datatables.byid');

Route::get('datatables/togglestatus/{id}', 'DatatablesController@ToggleStatus');


///////////////////////// User Route/////////////////////////////
Route::get('/users/{id}/edit','UserController@edit');
Route::get('/users/{id}/edit','UserController@edit');
Route::get('users/destroy/{id}','UserController@destroy');

Route::get('/users','UserController@getAll')
    ->name('datatables.userdata');
///////////////////////// RoomTask Route/////////////////////////////
Route::get('/roomtasks/create', 'RoomTaskController@GetCreateIndex');
Route::post('/roomtasks/create', 'RoomTaskController@store');
Route::get('/roomtasks/destroy/{id}','RoomTaskController@destroy');
///////////////////////// CarTasks Route/////////////////////////////
Route::get('/cartasks/create', 'CarTaskController@GetCreateIndex');
Route::post('/cartasks/create', 'CarTaskController@store');
Route::get('cartasks/destroy/{id}','CarTaskController@destroy');
Route::get('cartasks/togglestatus/{id}', 'CarTaskController@ToggleStatus');

Route::get('/cartask.cardata', 'CarTaskController@getCarTask')
    ->name('datatables.cardata');
Route::get('/cartaskid.carIddata', 'CarTaskController@getbyId')
    ->name('datatables.carIddata');
///////////////////////// CameraTasks Route/////////////////////////////

Route::get('/cameratasks/create', 'CameraTaskController@GetCreateIndex');
Route::post('cameratask/create', 'CameraTaskController@store');
Route::get('cameratask/destroy/{id}','CameraTaskController@destroy');
Route::get('cameratask/togglestatus/{id}', 'CameraTaskController@ToggleStatus');

Route::get('/cameratask','CameraTaskController@GetAllTask')
    ->name('datatables.cameradata');
Route::get('cameratask.Iddata', 'CameraTaskController@GetById')
    ->name('datatables.cameraIddata');

///////////////////////// Calendar Route/////////////////////////////

Route::get('/calendarroomdata', 'CalendarController@getRoomArraySQL');
Route::get('/calendarcardata', 'CalendarController@getCarArraySQL');
Route::get('/calendarcameradata', 'CalendarController@getCameraArraySQL');

///////////////////////// RoomList Route//////////////////////////////////
Route::post('/roomlists/create','RoomListController@store');
///////////////////////// CarList Route//////////////////////////////////
Route::post('/carlists/create','CarListController@store');
///////////////////////// Cameraman Route//////////////////////////////////
Route::post('/cameraman/create','CameraManController@store');
///////////////////////// Driver Route//////////////////////////////////
Route::post('/driver/create','DriverController@store');
///////////////////////// AllList Route//////////////////////////////////
Route::get('/alllists','AllListController@index');


