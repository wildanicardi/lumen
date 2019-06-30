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

$router->get('/', function () use ($router) {
    return "tes";
});

$router->post('/checklists','ChecklistController@store');
$router->get('/checklists/{id}','ChecklistController@show');
$router->patch('/checklists/{id}','ChecklistController@update');
$router->delete('/checklists/{id}','ChecklistController@destroy');

$router->post('/checklists/{id}/items','ItemController@store');

$router->get('/key', function() {
    return str_random(32);
});


//create checklist items
$router->post('/checklists/{checklistId}/items','ItemController@store');
//get checklist item
$router->get('/checklists/{checklistId}/items/{itemId}','ItemController@getChecklist');
// update checklist item
$router->patch('/checklists/{checklistId}/items/{itemId}','ItemController@update');
//delete checklist item
$router->delete('/checklists/{checklistId}/items/{itemId}','ItemController@destroy');
//list all item in given checklist
$router->get('/checklists/{checklistId}/items','ItemController@listAll');
//incomplete items
$router->post('/checklists/complete','ItemController@inCompleteItem');
//complete items
$router->post('/checklists/incomplete','ItemController@completeItem');