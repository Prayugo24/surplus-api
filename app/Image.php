<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

    protected $fillable = [
        'name',
        'file',
        'enable',
    ];

    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('file');
            $table->boolean('enable')->default(false);
            $table->timestamps();

            $table->index('id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('images');
    }
}
