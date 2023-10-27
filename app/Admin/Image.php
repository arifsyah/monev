<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //
    protected $fillable = [
        'nama',
        'path',
        'description',
    ];
}
