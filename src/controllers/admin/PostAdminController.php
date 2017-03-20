<?php namespace Group\Post\Controllers\Admin;

use Illuminate\Http\Request;
use Group\Post\Controllers\Admin\Controllers;
use URL;
use Route,
    Redirect;
use Group\Post\Models\Posts;
use Group\Post\Models\Users;

/**
 * Validators
 */
use Group\Post\Validators\PostAdminValidator;

class PostAdminController extends Controllers {

    public $data_view = array();

    private $obj_post = NULL;
    private $obj_users = NULL;

    private $obj_validator = NULL;

    public function __construct() {
        $this->obj_post = new Posts();
         $this->obj_users = new Users;
    }

    /**
     *
     * @return type
     */
    public function index(Request $request) {

         $params =  $request->all();

        $list_post = $this->obj_post->get_posts($params);

        $this->data_view = array_merge($this->data_view, array(
            'posts' => $list_post,
            'request' => $request,
            'params' => $params
        ));
        return view('post::post.admin.post_list', $this->data_view);
    }

    /**
     *
     * @return type
     */
    public function edit(Request $request) {

        $post = NULL;
        $post_id = (int) $request->get('id');
        if (!empty($post_id) && (is_int($post_id))) {
            $post = $this->obj_post->find($post_id);

        }
       

        $this->data_view = array_merge($this->data_view, array(
            'post' => $post,
            'request' => $request,
            'users' => $this->obj_users->pluckSelect()
        ));

      
        return view('post::post.admin.post_edit', $this->data_view);
    }

    /**
     *
     * @return type
     */
    public function up_post(Request $request) {
        $this->obj_validator = new postAdminValidator();

        $input = $request->all();

        $post_id = (int) $request->get('id');

        $post = NULL;

        $data = array();
        if (!$this->obj_validator->validate($input)) {

            $data['errors'] = $this->obj_validator->getErrors();

            if (!empty($post_id) && is_int($post_id)) {

                $post = $this->obj_post->find($post_id);
            }

        } else {
            if (!empty($post_id) && is_int($post_id)) {

                $post = $this->obj_post->find($post_id);

                if (!empty($post)) {

                    $input['post_id'] = $post_id;
                    $post = $this->obj_post->update_post($input);

                    //Message
                    $this->addFlashMessage('message', trans('post::post_admin.message_update_successfully'));
                    return Redirect::route("admin_post.edit", ["id" => $post->post_id]);
                } else {

                    //Message
                    $this->addFlashMessage('message', trans('post::post_admin.message_update_unsuccessfully'));
                }
            } else {

                $post = $this->obj_post->add_post($input);

                if (!empty($post)) {

                    //Message
                    $this->addFlashMessage('message', trans('post::post_admin.message_add_successfully'));
                    return Redirect::route("admin_post.edit", ["id" => $post->post_id]);
                } else {

                    //Message
                    $this->addFlashMessage('message', trans('post::post_admin.message_add_unsuccessfully'));
                }
            }
        }

        $this->data_view = array_merge($this->data_view, array(
            'post' => $post,
            'request' => $request,
        ), $data);

        return view('post::post.admin.post_edit', $this->data_view);
    }

    /**
     *
     * @return type
     */
    public function delete(Request $request) {

        $post = NULL;
        $post_id = $request->get('id');

        if (!empty($post_id)) {
            $post = $this->obj_post->find($post_id);

            if (!empty($post)) {
                  //Message
                $this->addFlashMessage('message', trans('post::post_admin.message_delete_successfully'));

                $post->delete();
            }
        } else {

        }

        $this->data_view = array_merge($this->data_view, array(
            'post' => $post,
        ));

        return Redirect::route("admin_post");
    }

}