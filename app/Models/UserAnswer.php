<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'exam_id',
        'question_id',
        'user_answer',
        'marks'
    ];

    public $timestamps = false;

    public function exams()
    {
        return $this->belongsTo(Exam::class);
    }

    public function questions()
    {
        return $this->hasOne(Questions::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
