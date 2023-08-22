<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['classroom_id','name','gender','slug','email','dob','contact','address','district','city','zipcode'];

    public function classroom(): BelongsTo
    {
        return $this->belongsTo(Classroom::class);
    }
}
