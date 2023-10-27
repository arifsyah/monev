<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    //
    //
    protected $table = 'subcategories';
    protected $fillable = [
        'title',
        'description'
    ];
}
