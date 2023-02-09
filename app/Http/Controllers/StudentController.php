<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Student;
use App\Models\StudentSubjectAssign;
use App\Models\Subject;
use App\Models\TeacherSubjectAssign;
use App\Models\Trimester;
use App\Traits\CommonList;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    use CommonList;
    public function student(Request $request){
        $data['batches'] = Batch::get();
        if($request->ajax()){
            $data = Student::with('getBatch')->paginate(20);
            $body = $this->studnetList($data,$data->currentPage(),$data->perPage());
            $paginate = $data->appends(request()->query())->links('pagination::bootstrap-4');
            $paginate = $paginate->render();
            return response()->json(['body'=>$body, 'paginate'=>$paginate]);
        }
        return view('student.index', $data);
    }

    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required',
            'code' => 'required',
            'mobile' => 'required',
            'batch_id' => 'required',
        ]);

        $data['email'] = $request->email;
        // dd($insert_data);

        if($request->row_id){
            Student::find($request->row_id)->update($data);
        }else{
            Student::create($data);
        }
        return response()->json(['message' => 'Student Created/Updated', 'redirectTo' => 'close', 'call' => 'loadData', 'description'=>'', 'timer'=>500]);
    }

    public function edit(Request $request){
        $info = Student::findOrFail($request->id);
        return response()->json(['info'=>$info]);
    }

    public function subjectAssign(){
        $data['students'] = Student::get();
        $data['trimesters'] = Trimester::get();
        $data['subjects'] = Subject::get();
        return view('student.subject_assign', $data);
    }

    public function assignedSubjet(Request $request){
        $infos = StudentSubjectAssign::with('getSubject')
            ->where('student', $request->student)
            ->where('trimester', $request->trimester)
            ->get();

        $html = '<table class="table">
            <thead>
                <tr>
                    <th>Sl</th>
                    <th>Course</th>
                </tr>
            </thead><tbody>';
            foreach($infos as $key=>$i){
                $html .= '<tr>
                    <td>'.($key+1).'</td>
                    <td>'.$i->getSubject->name.'</td>
                </tr>';
            }
            $html .= '</tbody></table>';
            return response()->json(['html' => $html]);
    }

    public function subjectAssignStore(Request $request){
        $info = $request->validate([
            'student' => 'required',
            'subject' => 'required',
            'trimester' => 'required',
        ]);

        $is_exist = StudentSubjectAssign::where($info)
            ->where('id', '!=', $request->row_id)
            ->first();

        if($is_exist){
            return response()->json(['message' => 'Already Assigned'], 421);
        }else{
            StudentSubjectAssign::create($info);
            return response()->json(['message' => 'Student Course Assigned', 'redirectTo' => 'close', 'call' => 'loadData', 'description'=>'', 'timer'=>500]);
        }
    }
}
