<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryModel;
use App\Helpers\Helpers;


class CategoryController extends Controller
{

    public function create(Request $request){
        $validator = Helpers::validatorCategory($request);

        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Body Yang Kosong',
                'data'    => $validator->errors()
            ],401);

        } else {
            $params = [
                'name'     => $request->input('name'),
                'enable'   => $request->input('enable')
            ];

            return CategoryModel::saveData($params);
        }

    }

    public function update ($id ,Request $request) {
        $validator = Helpers::validatorCategory($request);

        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please fill in the empty fields',
                'data'    => $validator->errors()
            ],401);
        } else {
            $params = [
                'id'     => $id,
                'name'     => $request->input('name'),
                'enable'   => $request->input('enable')
            ];

            return CategoryModel::updateData($params);
        }

    }


    public function delete($id) {
        if($id) {
            $params = [
                'id'     => $id,
            ];
            return CategoryModel::deleteData($params);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Category ID must be filled in!',
            ],401);
        }
    }

    public function detail($id) {
        if($id) {
            $params = [
                'id'     => $id,
            ];
            return CategoryModel::detailData($params);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Category ID must be filled in!',
            ],401);
        }
    }

    public function listData(Request $request) {
        $req = $request->all();
        $categoryName = (isset($req['name']) ? $req['name'] : '');
        $startIndex = (isset($req['start_index']) ? $req['start_index'] : 0);
        $recordCount = (isset($req['record_count']) ? $req['record_count'] : 10);
        $enable = (isset($req['enable'])) ?  filter_var($req['enable'], FILTER_VALIDATE_BOOLEAN) : null ;
        $params = [
            'name' => $categoryName,
            'enable' => $enable,
            'start_index' => $startIndex,
            'record_count' => $recordCount
        ];
        return CategoryModel::listData($params);
    }

}
