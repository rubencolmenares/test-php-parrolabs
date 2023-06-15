<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    //
    protected $fillable = ['id_user', 'age', 'education_level', 'salary_expectation', 'created_at'];
}
