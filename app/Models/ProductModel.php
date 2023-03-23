<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Product;
use App\CategoryProduct;
use App\ImageProduct;
use App\Image;
use App\Category;

class ProductModel extends Model {
    public static function saveData($params =[]) {
        $categoryId = (isset($params['category_id']) ? $params['category_id'] : []);
        $name = (isset($params['name']) ? $params['name'] : '');
        $nameImage = (isset($params['name_image']) ? $params['name_image'] : '');
        $file = (isset($params['file']) ? $params['file'] : '');
        $description = (isset($params['description']) ? $params['description'] : '');
        $enable = (isset($params['enable'])) ? filter_var($params['enable'], FILTER_VALIDATE_BOOLEAN) : FALSE ;
        $enableImage = (isset($params['enable_image'])) ? filter_var($params['enable_image'], FILTER_VALIDATE_BOOLEAN) : FALSE ;

        try {

            DB::beginTransaction();

            $resultProduct = Product::create([
                'name' => $name,
                'description' => $description,
                'enable' => $enable
            ]);
            $categoryIds = array_map(function($categoryId) use ($resultProduct) {
                return [
                    'category_id' => $categoryId,
                    'product_id' => $resultProduct->id
                ];
            }, $categoryId);

            CategoryProduct::insert($categoryIds);

            $resultImage = Image::create([
                'name' => $nameImage,
                'file' => $file,
                'enable' => $enableImage
            ]);

            $resultImageProduct = ImageProduct::create([
                'product_id' => $resultProduct->id,
                'image_id' => $resultImage->id,

            ]);

            DB::commit();

            $result = Product::whereId($resultProduct->id)->first();

            $categories = Category::select('categories.name')
                ->join('category_products', 'category_products.category_id', '=', 'categories.id')
                ->where('category_products.product_id', $resultProduct->id)
                ->get();

            $image = Image::select('images.name','images.file')
                ->join('image_products', 'image_products.image_id','=','images.id')
                ->where('image_products.product_id',$resultProduct->id)
                ->get();

            $result->categories = $categories;
            $result->images = $image;

            return [
                'success' => true,
                'data' => $result
            ];
        } catch (\Exception $e) {
            DB::rollback();
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }

    }

    public static function updateData($params =[]) {
        $produtcId = (isset($params['id']) ? $params['id'] : null);
        $name = (isset($params['name']) ? $params['name'] : '');
        $nameImage = (isset($params['name_image']) ? $params['name_image'] : '');
        $file = (isset($params['file']) ? $params['file'] : '');
        $description = (isset($params['description']) ? $params['description'] : '');
        $enable = (isset($params['enable'])) ? filter_var($params['enable'], FILTER_VALIDATE_BOOLEAN) : FALSE ;
        $enableImage = (isset($params['enable_image'])) ? filter_var($params['enable_image'], FILTER_VALIDATE_BOOLEAN) : FALSE ;
        $categoryId = isset($params['category_id']) ? $params['category_id'] : [];


        try {
            DB::beginTransaction();

            $categoryProduct = CategoryProduct::where("product_id",$produtcId);
            $categoryProduct->delete();

            $resultProduct = Product::whereId($produtcId)->update([
                'name' => $name,
                'description' => $description,
                'enable' => $enable
            ]);

            $categoryIds = array_map(function($categoryId) use ($produtcId) {
                return [
                    'category_id' => $categoryId,
                    'product_id' => $produtcId
                ];
            }, $categoryId);
            CategoryProduct::insert($categoryIds);

            $imageProduct = ImageProduct::where("product_id",$produtcId)->first();
            $resultImage = Image::whereId($imageProduct->image_id)->update([
                'name' => $nameImage,
                'file' => $file,
                'enable' => $enableImage
            ]);

            DB::commit();

            $result = Product::whereId($produtcId)->first();

            $categories = Category::select('categories.name')
                ->join('category_products', 'category_products.category_id', '=', 'categories.id')
                ->where('category_products.product_id', $result->id)
                ->get();

            $image = Image::select('images.name','images.file')
                ->join('image_products', 'image_products.image_id','=','images.id')
                ->where('image_products.product_id',$result->id)
                ->get();

            $result->categories = $categories;
            $result->images = $image;

            return [
                'success' => true,
                'data' => $result
            ];

        } catch (\Exception $e) {
            DB::rollback();
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }

    }

    public static function deleteData($params = []) {
        $productId = (isset($params['id']) ? $params['id'] : NULL);

        try {
            DB::beginTransaction();
            $imageProduct = ImageProduct::where("product_id",$productId);
            if ($imageProduct->count() > 0) {
                $imageId = $imageProduct->first()->image_id;
                $image = Image::where("id",$imageId);
                $image->delete();
                $imageProduct->delete();
            }

            $categoryProduct = CategoryProduct::where("product_id",$productId);
            $categoryProduct->delete();
            $product = Product::where("id",$productId);
            $product->delete();
            DB::commit();

            return [
                'success' => true,
                'message' => 'Product Delete Succes '
            ];

        } catch (\Exception $e) {
            DB::rollback();
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }

    }

    public static function detailData($params = []) {
        $id = (isset($params['id']) ? $params['id'] : NULL);
        $result = Product::whereId($id)->first();

        if ($result) {
            $result->enable = (bool) $result->enable;

            $categories = Category::select('categories.name')
                ->join('category_products', 'category_products.category_id', '=', 'categories.id')
                ->where('category_products.product_id', $id)
                ->get();

            $image = Image::select('images.name','images.file')
                ->join('image_products', 'image_products.image_id','=','images.id')
                ->where('image_products.product_id',$id)
                ->get();

            $result->categories = $categories;
            $result->images = $image;

            return [
                'success' => true,
                'message' => 'Data found',
                'data' => $result
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Data Product not found',
                'data' => ""
            ];
        }
    }



    public static function listData($params = []) {
        $name = (isset($params['name']) ? $params['name'] : NULL);
        $startIndex = (isset($params['start_index']) ? $params['start_index'] : 0);
        $recordCount = (isset($params['record_count']) ? $params['record_count'] : 10);
        $enable = (isset($params['enable'])) ? filter_var($params['enable'], FILTER_VALIDATE_BOOLEAN) : null ;
        $result = Product::query();

        if ($name) {
            $result->where('name', 'like', '%' . $name . '%');
        }
        if($enable !== null) {
            $enableNumber = intval($enable);
            $result->where('enable', '=',$enableNumber);
        }

        $products = $result->skip($startIndex)->take($recordCount)->get();

        if ($products->count() > 0) {
            $data = [];
            foreach ($products as $product) {
                $categories = Category::select('categories.name')
                    ->join('category_products', 'category_products.category_id', '=', 'categories.id')
                    ->where('category_products.product_id', $product->id)
                    ->get();

                $images = Image::select('images.name', 'images.file')
                    ->join('image_products', 'image_products.image_id', '=', 'images.id')
                    ->where('image_products.product_id', $product->id)
                    ->get();

                $data[] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'description' => $product->description,
                    'enable' => $product->enable,
                    'created_at' => $product->created_at->toDateTimeString(),
                    'updated_at' => $product->updated_at->toDateTimeString(),
                    'categories' => $categories,
                    'images' => $images
                ];
            }

            return [
                'success' => true,
                'message' => 'Data found',
                'data' => $data
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Data Product not found',
                'data' => []
            ];
        }
    }
}
