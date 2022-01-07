<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exam;


class showExamController extends Controller
{
    public function api()
    {
        // $exam = Exam::all();
        $exam = Exam::with('questions')->get();
        return response($exam);
    }
}
