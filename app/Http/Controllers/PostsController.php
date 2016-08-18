<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;

class PostsController extends Controller {

    public function __construct() {
        $this->middleware('oauth');
    }

    public function getAll(Request $request) {
        $posts = array('red', 'blue', 'green', 'yellow', 'sky', 'pink');
        return Response::create($posts, 201);
    }

}
