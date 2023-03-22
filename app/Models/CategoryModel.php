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
    public static function deleteData($params = []) {
        $id = (isset($params['id']) ? $params['id'] : NULL);
        
        $result = Category::findOrFail($id);
        $result->delete();

        if ($result) {
            return [
                'success' => true,
                'message' => 'Category Delete Succes '
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Failed to Delete category'
            ];
        }
    }

    }
}