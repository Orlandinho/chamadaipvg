<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    protected $guarded = [];

    public function aluno()
    {
    	return $this->hasMany(Aluno::class);
    }
}
