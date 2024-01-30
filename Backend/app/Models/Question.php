<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'opt1',
        'opt2',
        'opt3',
        'opt4',
        'correct_opt',
        'position_id'
    ];

    public function completeTests()
    {
        return $this->hasMany(CompleteTest::class);
    }
}
