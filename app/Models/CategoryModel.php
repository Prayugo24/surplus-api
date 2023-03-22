<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Category;

class CategoryModel extends Model {

    
    public static function saveData($params =[]) {
        $name = (isset($params['name']) ? $params['name'] : NULL);
        $enable = (isset($params['enable']) && $params['enable'] == 1) ? true : false; 

        
        $result = Category::create([
            'name'     => $name,
            'enable'   => $enable
        ]);
        

        if ($result) {
            return [
                'success' => true,
                'data' => $result
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Failed to save category'
            ];
        }
    }

    public static function updateData($params =[]) {
        $id = (isset($params['id']) ? $params['id'] : NULL);
        $name = (isset($params['name']) ? $params['name'] : NULL);
        $enable = (isset($params['enable']) && $params['enable'] == 1) ? true : false; 

        $result = Category::whereId($id)->update([
            'name'     => $name,
            'enable'   => $enable,
        ]);

        if ($result) {
            return [
                'success' => true,
                'data' => $result
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Failed to update category'
            ];
        }
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

    public static function detailData($params = []) {
        $id = (isset($params['id']) ? $params['id'] : NULL);

        $result = Category::whereId($id)->first();

        if ($result) {
            $result->enable = ($result->enable == 1) ? true : false;
            return [
                'success' => true,
                'message' => 'Data found',
                'data' => $result
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Data Category not found',
                'data' => ""
            ];
        }
    }

    public static function listData($params = []) {
        $name = (isset($params['name']) ? $params['name'] : NULL);
        $startIndex = (isset($params['start_index']) ? $params['start_index'] : 0);
        $recordCount = (isset($params['record_count']) ? $params['record_count'] : 10);

        $query = Category::query();

        if ($name) {
            $query->where('name', 'like', '%' . $name . '%');
        }

        $query->skip($startIndex)->take($recordCount);

        $result = $query->get();

        if ($result->isNotEmpty()) {
            $result->transform(function ($category) {
                $category->enable = ($category->enable == 1) ? true : false;
                return $category;
            });

            return [
                'success' => true,
                'message' => 'Data found',
                'data' => $result
            ];
        } else {
            return [
                'success' => false,
                'message' => 'No category found',
                'data' => []
            ];
        }
    }
}