<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'father_name',
        'email',
        'phone',
        'post_applied_for',
        'skills',
        'interviewer'
    ];
    
    public function tests()
    {
        return $this->hasMany(Test::class);
    }
}
