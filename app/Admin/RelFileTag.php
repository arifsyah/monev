<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class RelFileTag extends Model
{
    //
    protected $table = 'rel_files_tag';
    protected $fillable = [
        'id_files',
        'id_tag'
    ];
}
