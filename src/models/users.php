<?php

namespace Group\Post\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model {

    protected $table = 'users';
    public $timestamps = false;
    protected $fillable = [
        'email',
        'password',
        'permissions',
        'activated',
        'banned',
        'activation_code',
        'activated_at',
        'last_login',
        'persist_code',
        'reset_password_code',
        'protected',
        'created_at',
        'updated_at'
    ];
    protected $primaryKey = 'id';

    public function get_users($params = array()) {
        $eloquent = self::orderBy('id');

        if (!empty($params['email'])) {
            $eloquent->where('email', 'like', '%'. $params['email'].'%');
        }
        $user = $eloquent->paginate(10);
        return $user;
        
    }

    /**
     *
     * @param type $input
     * @param type $user_id
     * @return type
     */
    public function update_user($input, $id = NULL) {

        if (empty($id)) {
            $id = $input['id'];
        }

        $user = self::find($user_id);

        if (!empty($user)) {

            $user->email = $input['email'];

            $user->save();

            return $user;
        } else {
            return NULL;
        }
    }

    /**
     *
     * @param type $input
     * @return type
     */
    public function add_user($input) {

        $user = self::create([
                    'email' => $input['email'],
        ]);
        return $user;
    }

    /**
     * Get list of users
     * @param type $id
     * @return type
     */
    public function pluckSelect($id = NULL) {
        if ($id) {
            $user = self::where('id', '!=', $id)
                    ->orderBy('email', 'ASC')
                ->pluck('email', 'id');
        } else {
            $user = self::orderBy('email', 'ASC')
                ->pluck('email', 'id');
        }
        return $user;
    }

}
