<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;

/**
 * @SWG\Swagger(
 *     schemes={"http","https"},
 *     host="capitalnumbers.com",
 *     basePath="/",
 *     @SWG\Info(
 *         version="1.0.0",
 *         title="Lumen API Documentation",
 *         description="A Simple API for documentation purpose",
 *         @SWG\Contact(
 *             email="souravm@capitalnumbers.com"
 *         )
 *     )
 * )
 */
class PostsController extends Controller {

    public function __construct() {
        $this->middleware('oauth');
    }

    /**
     * @SWG\Post(
     *     path="/get-posts",
     *     summary="Get all posts present in the system",
     *     tags={"posts"},
     *     description="Get all post ids currently present on the system.",
     *     operationId="getAllposts",
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         name="paramOne",
     *         in="query",
     *         description="Paramater one",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="paramTwo",
     *         in="query",
     *         description="Paramater Two",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="clientid",
     *         in="header",
     *         description="Header Paramater one",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="clientSecret",
     *         in="header",
     *         description="Header Paramater two",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Response(
     *     response=200,
     *     description="successful operation",
     *     @SWG\Schema(
     *       type="object",
     *       additionalProperties={
     *         "type":"integer"
     *       }
     *     )
     *   ),
     *     @SWG\Response(
     *         response="400",
     *         description="Invalid tag value",
     *     )
     * )
     */
    public function getAll(Request $request) {
        $posts = array('red', 'blue', 'green', 'yellow', 'sky', 'pink');
        return Response::create($posts, 201);
    }

}
