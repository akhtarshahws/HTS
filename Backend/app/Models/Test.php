<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidate_id',
        'obtain_marks',
        'total_marks'
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }

    public function completeTests()
    {
        return $this->hasMany(CompleteTest::class);
    }
}
