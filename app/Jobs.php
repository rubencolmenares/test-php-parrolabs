<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
    //
    protected $fillable = ['rol', 'years_exp_required', 'salary'];

    //public function company()
    /*public function companies()
    {
        return $this->belongsTo(Companies::class);
    }*/
}
