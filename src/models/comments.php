<?php

namespace Group\Post\Models;

use Illuminate\Database\Eloquent\Model;
use DateTime;
use Carbon\Carbon;

class Comments extends Model {

    protected $table = 'comments';
    public $timestamps = false;
    protected $fillable = [
        'comment_content',
        'comment_id_parrent',
        'user_id',
        'comment_date',
        'comment_status',
        'post_id'
    ];
    protected $primaryKey = 'comment_id';

    /**

     *
     * @param type $params
     * @return type
     */
    public function get_comments($params = array()) {
        $eloquent = self::orderBy('comment_id','desc');

        if (!empty($params['post_title'])) {
            $eloquent->where('post_id',
        'like',
        '%'. $params['post_title'].'%');
        }
        $comments = $eloquent->join('users', 'id', '=', 'user_id')->paginate(10);
        
        $comments = $eloquent->paginate(10);

        return $comments;
    }

    /**
     *
     * @param type $input
     * @param type $comment_id
     * @return type
     */    

    /*
    public function update_comment($input,
        $comment_id = NULL) {

        if (empty($comment_id)) {
            $comment_id = $input['comment_id'];
        }

        $comment = self::find($comment_id);

        if (!empty($comment)) {

            $comment->comment_content = $input['comment_content'];
            $comment->comment_id_parrent = $input['comment_id_parrent'];
            $comment->user_id = $input['user_id'];
            $comment->comment_date = $input['comment_date'];
            $comment->comment_status = $input['status_id'];
            $comment->post_id = $input['post_id'];
            
            $comment->save();

            return $comment;
        } else {
            return NULL;
        }
    }
*/
    /**
     *
     * @param type $input
     * @return type
     */
    public function add_comment($input) {

        $comment = self::create([
            'comment_content' => $input['comment_content'],
            'user_id' => $input['user_id'],
            'post_id' => $input['post_id'],
            'comment_id_parrent' => $input['parent_id'],
            'comment_status' => $input['status_id'],
            'comment_date' => Carbon::now()->format('M d, Y')
        ]);

        return $comment;
    }
}
