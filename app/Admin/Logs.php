<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    //
    protected $fillable = [
        'id_user',
        'date_created',
        'module_name',
        'detail',
    ];

    public function admin()
    {
        return $this->hasOne('App\Admin','id');
    }
}
