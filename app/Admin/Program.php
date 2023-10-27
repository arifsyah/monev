<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    //
    protected $table = 'program';
    protected $fillable = [
        'title',
        'slug',
        'description'
    ];

    public function kinerja()
    {
        return $this->hasMany('Kinerja');
    }
}
