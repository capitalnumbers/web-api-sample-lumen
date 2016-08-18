<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class OauthMiddleware {

    public function handle($request, Closure $next) {
        $accessToken = $request->get('access_token');
        if (empty($accessToken)) {
            return response('You do not have access to the api', 500);
        }
        $req = $request->createFromGlobals();
        $bridgedRequest = \OAuth2\HttpFoundationBridge\Request::createFromRequest($req);
        $bridgedResponse = new \OAuth2\HttpFoundationBridge\Response();
        if (!$token = app()->make('oauth2')->getAccessTokenData($bridgedRequest, $bridgedResponse)) {
            $response = app()->make('oauth2')->getResponse();
            if ($response->isClientError() && $response->getParameter('error')) {
                return new Response('Your token has expired', 500);
            }
            return new Response('Invalid request', 500);
        } else {
            $request['user_id'] = $token['user_id'];
        }
        return $next($request);
    }

}
