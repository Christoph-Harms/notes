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

/** @var \Laravel\Lumen\Routing\Router $router */
$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/notes', function() {
    $notes = \App\Note::orderBy('created_at', 'desc')->get();

    return $notes;
});

$router->post('/notes', function(\Illuminate\Http\Request $req) {
    $data = $this->validate($req, [
        'text' => 'required|string',
        'type' => 'sometimes|in:primary,info,success,warning,danger',
    ]);

    $note = App\Note::create($data);

    return response($note, 201);
});

$router->get('/notes/{id}', function($id) {
    $note = \App\Note::findOrFail($id);

    return $note;
});

$router->put('/notes/{id}', function($id, \Illuminate\Http\Request $req) {
    $note = \App\Note::findOrFail($id);

    $data = $this->validate($req, [
        'text' => 'sometimes|string',
        'type' => 'sometimes|in:primary,info,success,warning,danger',
    ]);

    $note->update($data);

    return response('updated', 200);
});

$router->delete('/notes/{id}', function($id) {
    $note = \App\Note::findOrFail($id);

    $note->delete();

    return response('deleted', 200);
});
