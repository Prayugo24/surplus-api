<?php

namespace App\Helpers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class Helpers
{
    static function validatorsProduct($request) {
        $validator = Validator::make($request->all(),
            [
                'name'        => 'required',
                'description' => 'required',
                'enable'   => 'required',
                'enable_image'   => 'required',
                'category_id' => 'required',
                'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ],
            [
                'name.required' => 'Enter name product !',
                'description.required' => 'Enter description product value',
                'enable.required' => 'Enter enable product value',
                'category_id' => 'Enter Category id product value',
                'file.required' => 'Upload image file!',
                'file.image' => 'File must be an image',
                'file.mimes' => 'File format must be jpeg, png, jpg or gif',
                'file.max' => 'File size should not exceed 2MB',
                'enable.required' => 'Enter enable product value',
                'enable_image.required' => 'Enter enable image value',
            ]
        );

        return $validator;
    }

    static function validatorCategory($request){
        $validator = Validator::make($request->all(),
            [
                'name'     => 'required',
                'enable'   => 'required',
            ],
            [
                'name.required' => 'Enter name category !',
                'enable.required' => 'Enter enable category value',
            ]
        );

        return $validator;
    }
}
