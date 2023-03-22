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


    
}
