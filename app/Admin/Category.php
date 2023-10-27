<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = [
        'title',
        'description'
    ];

    // public function file(){
    // 	return $this->belongsTo('App\Admin\File','id_kategori');
    // }
}