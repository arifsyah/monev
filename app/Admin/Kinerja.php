<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Kinerja extends Model
{
    //
    protected $table = 'kinerja';
    protected $guarded = [];
    // protected $fillable = [];
    public function program()
    {
        return $this->belongsTo('Program');
    }
}
