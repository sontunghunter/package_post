<?php namespace Group\Post\Controllers\Admin;

use Illuminate\Http\Request;
use Group\Post\Controllers\Admin\Controllers;
use URL;
use Route,
    Redirect;
use Group\Post\Models\Users;
/**
 * Validators
 */
use Group\Post\Validators\UserAdminValidator;

class UserAdminController extends Controllers {

    public $data_view = array();

    private $obj_User = NULL;
    private $obj_users = NULL;

    private $obj_validator = NULL;

    public function __construct() {
        $this->obj_User = new Users();
    }

    /**
     *
     * @return type
     */
    public function index(Request $request) {

         $params =  $request->all();

        $list_User = $this->obj_User->get_Users($params);

        $this->data_view = array_merge($this->data_view, array(
            'Users' => $list_User,
            'request' => $request,
            'params' => $params
        ));
        return view('User::User.admin.User_list', $this->data_view);
    }

    /**
     *
     * @return type
     */
    public function edit(Request $request) {

        $User = NULL;
        $User_id = (int) $request->get('id');
        if (!empty($User_id) && (is_int($User_id))) {
            $User = $this->obj_User->find($User_id);

        }

        private $obj_users = new Users;

        $this->data_view = array_merge($this->data_view, array(
            'User' => $User,
            'request' => $request,
            'users' => $this->obj_sample_categories->pluckSelect()
        ));
        var_dump($this->data_view);die();
        
        return view('User::User.admin.User_edit', $this->data_view);
    }

    /**
     *
     * @return type
     */
    public function up_User(Request $request) {
        $this->obj_validator = new UserAdminValidator();

        $input = $request->all();

        $User_id = (int) $request->get('id');

        $User = NULL;

        $data = array();
        if (!$this->obj_validator->validate($input)) {

            $data['errors'] = $this->obj_validator->getErrors();

            if (!empty($User_id) && is_int($User_id)) {

                $User = $this->obj_User->find($User_id);
            }

        } else {
            if (!empty($User_id) && is_int($User_id)) {

                $User = $this->obj_User->find($User_id);

                if (!empty($User)) {

                    $input['User_id'] = $User_id;
                    $User = $this->obj_User->update_User($input);

                    //Message
                    $this->addFlashMessage('message', trans('User::User_admin.message_update_successfully'));
                    return Redirect::route("admin_User.edit", ["id" => $User->User_id]);
                } else {

                    //Message
                    $this->addFlashMessage('message', trans('User::User_admin.message_update_unsuccessfully'));
                }
            } else {

                $User = $this->obj_User->add_User($input);

                if (!empty($User)) {

                    //Message
                    $this->addFlashMessage('message', trans('User::User_admin.message_add_successfully'));
                    return Redirect::route("admin_User.edit", ["id" => $User->User_id]);
                } else {

                    //Message
                    $this->addFlashMessage('message', trans('User::User_admin.message_add_unsuccessfully'));
                }
            }
        }

        $this->data_view = array_merge($this->data_view, array(
            'User' => $User,
            'request' => $request,
        ), $data);

        return view('User::User.admin.User_edit', $this->data_view);
    }

    /**
     *
     * @return type
     */
    public function delete(Request $request) {

        $User = NULL;
        $User_id = $request->get('id');

        if (!empty($User_id)) {
            $User = $this->obj_User->find($User_id);

            if (!empty($User)) {
                  //Message
                $this->addFlashMessage('message', trans('User::User_admin.message_delete_successfully'));

                $User->delete();
            }
        } else {

        }

        $this->data_view = array_merge($this->data_view, array(
            'User' => $User,
        ));

        return Redirect::route("admin_User");
    }

}