<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobsHirings extends Model
{
    //
    protected $fillable = ['id_user', 'id_jobs_positions', 'hired'];
}
