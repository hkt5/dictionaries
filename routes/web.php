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

$router->get('/', 'FindAllDictionariesController@all');
$router->get('/find-by-id/{id}', 'FindDictionaryByIdController@findById');
$router->get('/find-by-name/{name}', 'FindDictionaryByNameController@findByName');
$router->get('/find-trashed', 'FindTrashedDictionariesController@findTrashed');
$router->get('/find-trashed/{id}', 'FindTrashedDictionaryByIdController@findTrashed');
$router->get('/dictionary-items', 'FindAllDictionaryItemsController@all');
$router->get('/dictionary-items/find-by-id/{id}', 'FindDictionaryItemByIdController@findById');
$router->get('/dictionary-items/find-trashed', 'FindTrashedDictionaryItemsController@findTrashed');
$router->get('/dictionary-items/find-single-trashed/{id}', 'FindTrashedDictionaryItemController@find');


$router->post('/create', 'CreateDictionaryController@create');
$router->post('/dictionary-item/create', 'CreateDictionaryItemController@create');
$router->put('/update', 'UpdateDictionaryController@update');
$router->put('/restore', 'RestoreDictionaryController@restore');
$router->put('/dictionary-item/update', 'UpdateDictionaryItemController@update');
$router->put('/dictionary-item/restore', 'RestoreDictionaryItemController@restore');
$router->delete('/delete', 'DeleteDictionaryController@delete');
$router->delete('/force-delete', 'ForceDeleteDictionaryController@forceDelete');
$router->delete('/dictionary-item/delete', 'DeleteDictionaryItemController@delete');
$router->delete('/dictionary-item/force-delete', 'ForceDeleteDictionaryItemController@forceDelete');
