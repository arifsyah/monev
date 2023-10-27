<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    //
    protected $table = 'kegiatan';
    protected $fillable = [
        'title',
        'slug',
        'id_program',
        'description'
    ];
}
