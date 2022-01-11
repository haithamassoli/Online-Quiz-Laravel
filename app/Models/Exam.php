<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_name',
        'exam_desc',
        'exam_num_qus',
        'exam_img',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function userAnswer()
    {
        return $this->hasMany(UserAnswer::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
