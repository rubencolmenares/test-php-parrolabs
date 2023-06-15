<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Companies extends Model
{
    //
    protected $fillable = ['id_user', 'address', 'zip_code', 'total_positions', 'budget'];
    
}
