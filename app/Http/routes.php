<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', ['as' => 'index', 'uses'=>'DockerfileParser@index']);
Route::get('/repositories', ['as' => 'repositories', 'uses'=>'RegistriesController@index']);

Route::post('/upload', ['as' => 'upload_dockerfile', 'uses' => 'DockerfileParser@create'
]);
Route::post('/download', ['as' => 'download_dockerfile', 'uses' => 'DockerfileParser@download']);
Route::post('/kubernetes/rc/create', ['as' => 'create_replication_controller',
    'uses' => 'NodesManagementController@createReplicationController']);
Route::post('/kubernetes/service/create', ['as' => 'create_service',
    'uses' => 'NodesManagementController@createService']);


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});
