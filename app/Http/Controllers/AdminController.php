<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Answer;
use App\Models\QnaExam;

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
            $unique_id =  uniqid('exid');
            Exam::insert([
                'exams_name' => $request->exams_name,
                'entrance_id' => $unique_id
            ]);
            return response()->json(['success' => true, 'msg' => 'Exam added successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => 'false', 'msg' => $e->getMessage()]);
        };
    }

    public function qnaDashboard()
    {
        $questions = Question::with('answers')->get();
        return view('admin.qnaDashboard', compact('questions'));
    }


    //add Qna
    public function addQna(Request $request)
    {
        try {

            $questionId = Question::insertGetId([
                'question' => $request->question
            ]);

            foreach ($request->answers as $answer) {

                $is_correct = 0;
                if ($request->is_correct == $answer) {
                    $is_correct = 1;
                }
                Answer::insert([
                    'questions_id' => $questionId,
                    'answer' => $answer,
                    'is_correct' => $is_correct
                ]);
            }

            return response()->json(['success' => true, 'msg' => 'Exam added successfully']);
        } catch (\Exception $e) {
            dd($e);
            return response()->json(['success' => 'false', 'msg' => $e->getMessage()]);
        };
    }

    public function studentsDashboard()
    {

        $students = User::where('is_admin', 0)->get();
        return view('admin.studentsDashboard', compact('students'));
    }

    public function getQuestions(Request $request)
    {
        try {
            $questions = Question::all();

            if (count($questions) > 0) {
                $data = [];
                $counter = 0;
                foreach ($questions as $question) {
                    $qnaExam = QnaExam::where(['exam_id' => $request->exam_id, 'question_id' => $question->id])->get();
                    if (count($qnaExam) == 0) {
                        $data[$counter]['id'] = $question->id;
                        $data[$counter]['questions'] = $question->question;
                        $counter++;
                    }
                }
                return response()->json(['success' => true, 'msg' => 'Questions data!', 'data' => $data]);
            } else {
                return response()->json(['success' => False, 'msg' => 'Questions not found!']);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => False, 'msg' => $e->getMessage()]);
        }
    }

    public function addQuestions(Request $request)
    {
        try {
            // return response()->json($request->all());
            if (isset($request->questions_id)) {
                foreach ($request->questions_id as $qid) {
                    QnaExam::insert([
                        'exam_id' => $request->exam_id,
                        'question_id' => $qid
                    ]);
                }
            }
            return response()->json(['success' => true, 'msg' => 'Questions added Successfully!']);
        } catch (\Exception $e) {
            return response()->json(['success' => False, 'msg' => $e->getMessage()]);
        }
    }
    //delete exam

    public function deleteExam(Request $request)
    {
        try {
            Exam::where('id', $request->exam_id)->delete();
            return response()->json(['success' => true, 'msg' => 'Exam deleted Successfully!']);
        } catch (\Exception $e) {
            return response()->json(['success' => False, 'msg' => $e->getMessage()]);
        }
    }
}
