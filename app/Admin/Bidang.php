<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    //
    protected $table = 'bidang';
    protected $fillable = [
        'title',
        'description'
    ];
}
