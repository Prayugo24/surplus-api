<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Category;

class CategoryModel extends Model {

    
    public static function saveData($params =[]) {
        $name = (isset($params['name']) ? $params['name'] : NULL);
        $enable = (isset($params['enable']) && $params['enable'] == 1) ? true : false; 

        
        $post = Category::create([
            'name'     => $name,
            'enable'   => $enable
        ]);
        

        if ($post) {
            return [
                'success' => true,
                'data' => $post
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Failed to save category'
            ];
        }

    }
}