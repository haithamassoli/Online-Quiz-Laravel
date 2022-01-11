<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_content',
        'question_options',
        'correct_answer',
        'question_point',
        'exam_id',
    ];

    public $timestamps = false;

    public function exams()
    {
        return $this->belongsTo(Exam::class);
    }

    public function userAnswer()
    {
        return $this->hasOne(UserAnswer::class);
    }
}
