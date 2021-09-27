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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// update profile user
Route::get('/user/{id}', 'UserController@profile')->name('user.profile');
Route::get('/editprofile/user/', 'UserController@edit')->name('user.edit');
Route::post('/editprofile/user/', 'UserController@update')->name('user.update');
Route::get('/editpassword/user/', 'UserController@passwordedit')->name('user.passwordedit');
Route::post('/editpassword/user/', 'UserController@passwordupdate')->name('user.passwordupdate');


// homepagepage by role
Route::get('/home', 'HomeController@userhome')->middleware('role');
Route::get('/summary/{id}', 'HomeController@summary');


// project controller
Route::resource('projects', 'ProjectController');
Route::get('projects/team/{id}', 'ProjectController@listteamproject');
Route::get('projects/team/edit/{id}', 'ProjectController@editteamproject')->name('team.edit');
Route::post('projects/team/edit/{id}', 'ProjectController@updateteamproject')->name('team.update');
Route::get('projects/team/destroy/{project}/{id}', 'ProjectController@destroymember')->name('team.destroy');


// requirement controller
Route::resource('requirements', 'RequirementController');
Route::get('/requirements/create/{id}', 'RequirementController@createreq')->name('requirements.createreq');
Route::post('/requirements/{id}', 'RequirementController@storereq')->name('requirements.storereq');
Route::get('requirements/destroy/{id}', 'RequirementController@destroy');

// testcase controller
Route::resource('testcases', 'TestcaseController');
Route::get('/testcases/create/{id}', 'TestcaseController@createtc')->name('testcases.createtc');
Route::post('/testcases/{id}', 'TestcaseController@storetc')->name('testcases.storetc');
Route::get('/testruns/{id}', 'TestcaseController@listtestrun')->name('testruns.list');
Route::get('/testruns/detail/{project}/{id}', 'TestcaseController@testrun')->name('testruns.detail');
Route::get('testcases/destroy/{id}', 'TestcaseController@destroy');

// testresult controller
Route::resource('testresults', 'TestresultController');
Route::get('/testresults/create/{id}', 'TestresultController@createtr')->name('testresults.createtr');
Route::post('/testresults/{id}', 'TestresultController@storetr')->name('testresults.storetr');
Route::get('testresults/destroy/{id}', 'TestresultController@destroy');
//Route::get('testresults/{id}/editdefect', 'TestresultController@editdefect')->name('testresults.editdefect');
//Route::post('testresults/{id}/updatedefect', 'TestresultController@updatedefect')->name('testresults.updatedefect');

