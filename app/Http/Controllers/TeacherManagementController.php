<?php

namespace App\Http\Controllers;

use App\Models\Studentmark;
use App\Models\StudentSubjectAssign;
use App\Models\Subject;
use App\Models\TeacherSubjectAssign;
use App\Models\Trimester;
use Illuminate\Http\Request;

class TeacherManagementController extends Controller
{
    public function assignedSubjet(Request $request){

        $data['infos'] = TeacherSubjectAssign::with('getBatch','getSubject')
            ->where('teacher', active_user())
            ->where('trimester', currTrimester())
            ->get();
        return view('teacher_panel.subject_assign', $data);
    }

    public function setMark(Request $request){
        $data['students'] = StudentSubjectAssign::where('trimester', currTrimester())
            ->where('subject', $request->subject)
            ->with('getStudent.getBatch')
            ->whereHas('getStudent', function($qry)use($request){
                $qry->where('batch_id', $request->batch);
            })
            ->get();
        $data['marks'] = Studentmark::where('subject_id', $request->subject)->where('trimester_id', currTrimester())->get();
        $data['subject'] = Subject::find($request->subject);
        $data['trimester'] = Trimester::find(currTrimester());
        return view('teacher_panel.set_mark', $data);
    }

    public function setMarkStore(Request $request){
        // dd($request->all());
        foreach($request->student as $key=>$s){
            $data = [
                'cr1' => $request->cr1[$key] ?? 0,
                'cr2' => $request->cr2[$key] ?? 0,
                'cr3' => $request->cr3[$key] ?? 0,
                'cr4' => $request->cr4[$key] ?? 0,
                'cr5' => $request->cr5[$key] ?? 0,
                'cr6' => $request->cr6[$key] ?? 0,
                'cr7' => $request->cr7[$key] ?? 0,
                'cr8' => $request->cr8[$key] ?? 0,
                'cr9' => $request->cr9[$key] ?? 0,
            ];
            Studentmark::updateOrCreate([
                'student_id' => $request->student[$key],
                'trimester_id' => currTrimester(),
                'subject_id' => $request->subject
            ],$data);
        }
        return response()->json(['message'=>'Updated', 'redirectTo'=> 'reload', 'timer'=>500]);
    }

    public function getMark(Request $request){
        $data['students'] = StudentSubjectAssign::where('trimester', currTrimester())
            ->where('subject', $request->subject)
            ->with('getStudent.getBatch')
            ->whereHas('getStudent', function($qry)use($request){
                $qry->where('batch_id', $request->batch);
            })
            ->get();
        $data['marks'] = Studentmark::where('subject_id', $request->subject)->where('trimester_id', currTrimester())->get();
        $data['subject'] = Subject::find($request->subject);
        $data['trimester'] = Trimester::find(currTrimester());
        return view('teacher_panel.get_mark', $data);
    }
}
