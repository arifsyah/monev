<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class FileHistory extends Model
{
    //
    protected $table = 'files_history';
    protected $fillable = [
        'id_kategori',
        'title',
        'tahun',
        'updated_at',
        'users_created',
        'users_modified',
        'path',
        'id_file',
        'description'
    ];
}
