<?php

namespace Group\Post\Models;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model {

    protected $table = 'posts';
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'user_id_assigned',
        'user_id_reviewer',
        'category_id',
        'level_id',
        'status_id',
        'post_title',
        'post_overview',
        'post_description',
        'post_notes',
        'post_cache_page',
        'post_likes',
        'post_views',
        'post_attachment',
        'post_points',
        'post_image',
        'post_images',
        'post_created_at',
        'post_updated_at',
        'created_at',
        'updated_at'
    ];
    protected $primaryKey = 'post_id';

    /**
     *
     * @param type $params
     * @return type
     */
    public function get_posts($params = array()) {
        $eloquent = self::orderBy('post_id');

        //post_title
        if (!empty($params['post_title'])) {
            $eloquent->where('post_title',
        'like',
        '%'. $params['post_title'].'%');
        }

        $posts = $eloquent->paginate(10);//TODO: change number of item per page to configs

        return $posts;
    }



    /**
     *
     * @param type $input
     * @param type $post_id
     * @return type
     */
    public function update_post($input,
        $post_id = NULL) {

        if (empty($post_id)) {
            $post_id = $input['post_id'];
        }

        $post = self::find($post_id);

        if (!empty($post)) {

            $post->post_title = $input['post_title'];
            $post->post_overview = $input['post_overview'];
            $post->post_description = $input['post_description'];
            $post->post_notes = $input['post_notes'];
            $post->user_id_assigned = $input['user_id_assigned'];
            $post->user_id_reviewer = $input['user_id_reviewer'];

            $post->save();

            return $post;
        } else {
            return NULL;
        }
    }

    /**
     *
     * @param type $input
     * @return type
     */
    public function add_post($input) {
        
        $post = self::create([
                    'post_title' => $input['post_title'],
                    'post_overview' => $input['post_overview'],
                    'post_description' => $input['post_description'],
                    'post_notes' => $input['post_notes'],
                    'user_id_assigned' => $input['user_id_assigned'],
                    'user_id_reviewer' => $input['user_id_reviewer'],
                    'user_id' => $input['user_id'],
                    'category_id' => $input['category_id'],
                    

        ]);
        return $post;
    }
}
