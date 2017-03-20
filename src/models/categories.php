<?php

namespace Group\Post\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model {

    protected $table = 'categories';
    public $timestamps = false;
    protected $fillable = [
        'category_name'
    ];
    protected $primaryKey = 'category_id';

    public function get_categories($params = array()) {
        $eloquent = self::orderBy('category_id');

        if (!empty($params['category_name'])) {
            $eloquent->where('category_name', 'like', '%'. $params['category_name'].'%');
        }
        $category = $eloquent->paginate(10);
        return $category;
        
    }

    /**
     *
     * @param type $input
     * @param type $category_id
     * @return type
     */
    public function update_category($input, $category_id = NULL) {

        if (empty($category_id)) {
            $category_id = $input['category_id'];
        }

        $category = self::find($category_category_id);

        if (!empty($category)) {

            $category->category_name = $input['category_name'];

            $category->save();

            return $category;
        } else {
            return NULL;
        }
    }

    /**
     *
     * @param type $input
     * @return type
     */
    public function add_category($input) {

        $category = self::create([
                    'category_name' => $input['category_name'],
        ]);
        return $category;
    }

    /**
     * Get list of categories
     * @param type $category_id
     * @return type
     */
    public function pluckSelect($category_id = NULL) {

        if ($category_id) {
            $category = self::where('category_id', '!=', $category_id)
                    ->orderBy('category_name', 'ASC')
                ->pluck('category_name', 'category_id');
        } else {
            $category = self::orderBy('category_name', 'ASC')
                ->pluck('category_name', 'category_id');
        }
   
        return $category;
    }

}
