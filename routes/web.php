<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('file', [
    'as' => 'get-file', 'uses' => 'FileController@index'
]);

$router->post('send_file', [
    'as' => 'send-file', 'uses' => 'FileController@store'
]);

$router->get('/', function () use ($router) {
    return [
    	'data' => 'welcome to baba api'
    ];
});
