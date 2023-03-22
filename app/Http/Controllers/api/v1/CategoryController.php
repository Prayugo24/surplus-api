<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryModel;
use Illuminate\Support\Facades\Validator;


class CategoryController extends Controller
{
    
    public function save(Request $request){
        $validator = Validator::make($request->all(), 
            [
                'name'     => 'required',
                'enable'   => 'required',
            ],
            [
                'name.required' => 'Masukkan name category !',
                'enable.required' => 'Masukka value enable category',
            ]
        );

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

    public function delete($id) {
        if($id) {
            $params = [
                'id'     => $id,
            ];
            return CategoryModel::deleteData($params);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'ID category harus diisi!',
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
                'message' => 'ID category harus diisi!',
            ],401);
        }
    }

    public function listData(Request $request) {
        $req = $request->all();
        $categoryName = (isset($req['name']) ? $req['name'] : '');
        $startIndex = (isset($req['start_index']) ? $req['start_index'] : 0);
        $recordCount = (isset($req['record_count']) ? $req['record_count'] : 10);
        $params = [
            'name' => $categoryName,
            'start_index' => $startIndex,
            'record_count' => $recordCount
        ];
        return CategoryModel::listData($params);
    }
    
}
