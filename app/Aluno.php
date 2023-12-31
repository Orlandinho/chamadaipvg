<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    protected $guarded = [];

    public function sala()
    {
    	return $this->belongsTo(Sala::class);
    }
}
