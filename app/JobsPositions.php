<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobsPositions extends Model
{
    //
    protected $fillable = ['id_company', 'id_jobs', 'position_budget', 'available_positions'];
}
