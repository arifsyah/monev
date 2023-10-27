<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Subkegiatan extends Model
{
    //
    protected $table = 'subkegiatan';
    protected $fillable = [
        'title',
        'slug',
        'id_kegiatan',
        'description'
    ];
}
