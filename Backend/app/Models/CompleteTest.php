<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompleteTest extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_id',
        'selected_opt',
        'mark',
        'test_id'
    ];

    public function test()
    {
        return $this->belongsTo(Test::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
