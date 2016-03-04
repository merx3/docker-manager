<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instruction extends Model
{
    //
    protected $table = 'instructions';

    public function dockerfile()
    {
        return $this->belongsTo('Dockerfile');
    }
}