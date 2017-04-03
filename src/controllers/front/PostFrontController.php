<?php namespace Group\Post\Controllers\Front;

use Illuminate\Http\Request;
use Group\Post\Controllers\Front\Controllers;
use URL;
use Route,
    Redirect;
use Group\Post\Models\Posts;
use Group\Post\Models\Users;
use Group\Post\Models\Comments;
use Group\Post\Models\Categories;

/**
 * Validators
 */
use Group\Post\Validators\PostFrontValidator;

class PostFrontController extends Controllers {

    public $data_view = array();

    private $obj_post = NULL;
    private $obj_users = NULL;

    private $obj_validator = NULL;

    public function __construct() {
        $this->obj_post = new Posts();
        $this->obj_users = new Users();
        $this->obj_comments = new Comments();
        $this->obj_categories = new Categories();
    }

    /**
     *
     * @return type
     */
    public function index(Request $request) {

         $params =  $request->all();

        $list_post = $this->obj_post->get_posts($params);
        $list_comment = $this->obj_comments->get_comments($params);

        $this->data_view = array_merge($this->data_view, array(
            'comments' => $list_comment,
            'posts' => $list_post,
            'request' => $request,
            'params' => $params
        ));
        return view('post::post.front.post_index', $this->data_view);
    }
}