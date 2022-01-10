<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\User;
use App\Models\UserAnswer;
use Illuminate\Support\Facades\Auth;

class showExamController extends Controller
{
    public function index($id)
    {
        $exam = Exam::where('id',$id)->with('questions')->get();
        return response($exam);
    }

    public function create(Request $request)
    {
        $user = UserAnswer::create([
            'exam_id' => $request->input('exam_id'),
            'user_id' => $request->input('user_id'),
            'question_id' => $request->input('question_id'),
            'user_answer' => $request->input('user_answer'),
            'marks' => $request->input('marks'),
        ]);
        return response($user);
    }
}
