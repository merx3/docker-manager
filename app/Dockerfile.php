<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Instruction;

class Dockerfile extends Model
{
    //
    protected $table = 'dockerfiles';

    public function instructions()
    {
        return $this->hasMany('App\Instruction');
    }
}
