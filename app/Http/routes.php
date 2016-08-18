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

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Request;

$app->withFacades();
//re-add the App facade removed in 5.2:
class_alias('Illuminate\Support\Facades\App', 'App');

App::singleton('oauth2', function() {

    $storage = new OAuth2\Storage\Pdo(App::make('db')->getPdo());
    $server = new OAuth2\Server($storage);

    $server->addGrantType(new OAuth2\GrantType\ClientCredentials($storage));
    $server->addGrantType(new OAuth2\GrantType\UserCredentials($storage));

    return $server;
});

$app->middleware([
    App\Http\Middleware\HttpAuthMiddleware::class
]);

$app->routeMiddleware([
    'oauth' => App\Http\Middleware\OauthMiddleware::class,
]);

$app->get('/', function() {
    return Response::create('hello', 200);
});

$app->post('oauth/token', function() {
    $bridgedRequest = OAuth2\HttpFoundationBridge\Request::createFromRequest(Request::instance());
    $bridgedResponse = new OAuth2\HttpFoundationBridge\Response();

    $bridgedResponse = App::make('oauth2')->handleTokenRequest($bridgedRequest, $bridgedResponse);

    return $bridgedResponse;
});


$app->post('/get-posts', 'PostsController@getAll');
