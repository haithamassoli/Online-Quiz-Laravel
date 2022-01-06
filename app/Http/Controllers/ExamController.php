<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Http\Requests\StoreExamRequest;
use App\Http\Requests\UpdateExamRequest;
use App\Models\Question;
use Illuminate\Http\Request;


class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exams = Exam::all();
        return view('admin.exams', compact('exams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.exam_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreExamRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'exam_name' => 'required',
            'exam_desc' => 'required',
            'exam_num_qus' => 'required|integer',
            'exam_img' => 'mimes:jpg,png,jpeg|max:5048'
        ]);

        if ($request->hasfile('exam_img')){

            $newImageName = time().'-'.$request->exam_name . '.'.$request->exam_img->extension();
            $request->exam_img->move(public_path('img'), $newImageName);

            $exam = Exam::create([
                'exam_name' => $request->input('exam_name'),
                'exam_desc' => $request->input('exam_desc'),
                'exam_num_qus' => $request->input('exam_num_qus'),
                'exam_img' => $newImageName,
        ]);
        return redirect('admin/exams')->with('success', 'Added successfully');
    } else {
        $exam = Exam::create([
            'exam_name' => $request->input('exam_name'),
            'exam_desc' => $request->input('exam_desc'),
            'exam_num_qus' => $request->input('exam_num_qus'),
        ]);
        return redirect('admin/exams')->with('success', 'Added successfully');
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $exam = Exam::find($id);
        $questions = Question::where('exam_id', $id)->get();
        // dd($questions);
        return view('admin.show_exam',compact(['exam','questions']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $exam = Exam::find($id);
        return view('admin.edit_exam',compact('exam'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateExamRequest  $request
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'exam_name' => 'required',
            'exam_desc' => 'required',
            'exam_num_qus' => 'required|integer',
            'exam_img' => 'mimes:jpg,png,jpeg|max:5048'
        ]);

    if ($request->hasfile('image')){
        $newImageName = time().'-'.$request->exam_name . '.'.$request->exam_img->extension();
        $request->exam_img->move(public_path('img'), $newImageName);

        $exam = Exam::where('id', $id)
        ->update([
            'exam_name' => $request->input('exam_name'),
            'exam_desc' => $request->input('exam_desc'),
            'exam_num_qus' =>  $request->input('exam_num_qus'),
            'exam_img' => $newImageName,
    ]);
    return redirect('admin/exams')->with('success', 'Updated successfully');
    } else {
        $exam = Exam::where('id', $id)
        ->update([
            'exam_name' => $request->input('exam_name'),
            'exam_desc' => $request->input('exam_desc'),
            'exam_num_qus' => $request->input('exam_num_qus'),
    ]);
    return redirect('admin/exams')->with('success', 'Updated successfully');
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Exam::destroy($id);
        return redirect('admin/exams')->with('success', 'Deleted successfully');
    }
}
