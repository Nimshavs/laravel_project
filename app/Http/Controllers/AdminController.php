<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Exam;

class AdminController extends Controller
{
    //dashboard load
    public function examDashboard()
    {
        $exams = Exam::all();
        return view('admin.dashboard', ['exams' => $exams]);
    }

    //add exam
    public function addExam(Request $request)
    {
        // dd($request->all());
        try {
            Exam::insert([
                'exams_name' => $request->exams_name
            ]);
            return response()->json(['success' => true, 'msg' => 'Exam added successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => 'false', 'msg' => $e->getMessage()]);
        };
    }

    public function qnaDashboard()
    {
        return view('admin.qnaDashboard');
    }


    public function studentsDashboard()
    {

        $students = User::where('is_admin', 0)->get();
        return view('admin.studentsDashboard', compact('students'));
    }
}
