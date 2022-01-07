<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $exams = Exam::all();
        return view('dashboard', compact('exams'));
    }

    public function show($id)
    {
        $exam = Exam::find($id);
        return view('exam', compact('exam'));
    }
}
