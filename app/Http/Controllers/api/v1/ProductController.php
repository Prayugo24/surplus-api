<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductModel;
use App\Helpers\Helpers;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function create(Request $request){
        $validator = Helpers::validatorsProduct($request);

        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Body Yang Kosong',
                'data'    => $validator->errors()
            ],401);

        } else {

            $params = [
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'category_id' => explode(",",$request->input('category_id')),
                'enable' => $request->input('enable'),
            ];

            if ($request->hasFile('file')) {
                try {
                    $file = $request->file('file');
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $path = $file->storeAs('public/images', $filename);
                    $imageName = $filename; // update $imageName variable
                } catch (\Exception $e) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Failed to upload file',
                        'data' => $e->getMessage(),
                    ], 500);
                }
            }
            $params['name_image'] = $imageName;
            $params['enable_image'] = $imageName;
            $params['file'] = url('storage/' . $imageName);

            return ProductModel::saveData($params);
        }

    }


    public function update ($id ,Request $request) {
        $validator = Helpers::validatorsProduct($request);

        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please fill in the empty fields',
                'data'    => $validator->errors()
            ],401);
        } else {
            $params = [
                'id' => $id,
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'category_id' => explode(",",$request->input('category_id')),
                'enable' => $request->input('enable'),
            ];

            if ($request->hasFile('file')) {
                try {
                    $file = $request->file('file');
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $path = $file->storeAs('public/images', $filename);
                    $imageName = $filename; // update $imageName variable
                } catch (\Exception $e) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Failed to upload file',
                        'data' => $e->getMessage(),
                    ], 500);
                }
            }
            $params['name_image'] = $imageName;
            $params['enable_image'] = $imageName;
            $params['file'] = url('storage/' . $imageName);

            return ProductModel::updateData($params);
        }

    }

    public function delete($id) {
        if($id) {
            $params = [
                'id'     => $id,
            ];
            return ProductModel::deleteData($params);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Product ID must be filled in!',
            ],401);
        }
    }

    public function detail($id) {
        if($id) {
            $params = [
                'id'     => $id,
            ];
            return ProductModel::detailData($params);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Product ID must be filled in!',
            ],401);
        }
    }

    public function listData(Request $request) {
        $req = $request->all();
        $productName = (isset($req['name']) ? $req['name'] : '');
        $startIndex = (isset($req['start_index']) ? $req['start_index'] : 0);
        $recordCount = (isset($req['record_count']) ? $req['record_count'] : 10);
        $enable = (isset($req['enable'])) ?  filter_var($req['enable'], FILTER_VALIDATE_BOOLEAN) : null ;
        $params = [
            'name' => $productName,
            'enable' => $enable,
            'start_index' => $startIndex,
            'record_count' => $recordCount
        ];
        return ProductModel::listData($params);
    }
}
