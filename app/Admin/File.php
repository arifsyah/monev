<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    //
    protected $table = 'files';
    protected $fillable = [
        'id_kategori',
        'id_bidang',
        'title',
        'tahun',
        'updated_at',
        'users_modified',
        'description'
    ];

    // public function category(){
    // 	return $this->hasMany('App\Admin\Category','id_kategori');
    // }

}
