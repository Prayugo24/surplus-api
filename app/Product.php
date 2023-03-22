<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'enable',
    ];

    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->boolean('enable')->default(false);
            $table->timestamps();

            $table->index('id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
