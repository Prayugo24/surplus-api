<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'enable',
    ];
    
    public function up()
    {
        Schema:create("categories", function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('enable')->default(false);
            $table->timestamp();
            $table->index('id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
