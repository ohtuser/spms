<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Subject;
use App\Models\TeacherSubjectAssign;
use App\Models\Trimester;
use App\Models\User;
use App\Traits\CommonList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    use CommonList;
    public function teacher(Request $request){
        if($request->ajax()){
            $data = User::where('user_type', 2)
                ->paginate(20);
            $body = $this->teacherList($data,$data->currentPage(),$data->perPage());
            $paginate = $data->appends(request()->query())->links('pagination::bootstrap-4');
            $paginate = $paginate->render();
            return response()->json(['body'=>$body, 'paginate'=>$paginate]);
        }
        return view('teacher.index');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'email' => 'required|email|unique:users,email,'.$request->row_id
        ]);

        if(!$request->row_id){
            $request->validate([
                'password' => 'required'
            ]);
        }

        $insert_data = [
            'name' => $request->name,
            'code' => $request->code,
            'email' => $request->email,
            'designation' => $request->designation,
            'mobile' => $request->mobile,
            'user_type' => 2
        ];
        // dd($insert_data);

        if($request->row_id){
            User::find($request->row_id)->update($insert_data);
        }else{
            $insert_data['password'] = Hash::make($request->password);
            User::create($insert_data);
        }
        return response()->json(['message' => 'Teacher Created/Updated', 'redirectTo' => 'close', 'call' => 'loadData', 'description'=>'', 'timer'=>500]);
    }

    public function edit(Request $request){
        $info = User::findOrFail($request->id);
        return response()->json(['info'=>$info]);
    }

    public function subjectAssign(){
        $data['teachers'] = User::where('user_type', 2)->get();
        $data['trimesters'] = Trimester::get();
        $data['batches'] = Batch::get();
        $data['subjects'] = Subject::get();
        return view('teacher.subject_assign', $data);
    }

    public function assignedSubjet(Request $request){
        $infos = TeacherSubjectAssign::with('getBatch','getSubject')
            ->where('teacher', $request->teacher)
            ->where('trimester', $request->trimester)
            ->get();

        $html = '<table class="table">
            <thead>
                <tr>
                    <th>Sl</th>
                    <th>Subject</th>
                    <th>Batch</th>
                </tr>
            </thead><tbody>';
            foreach($infos as $key=>$i){
                $html .= '<tr>
                    <td>'.($key+1).'</td>
                    <td>'.$i->getSubject->name.'</td>
                    <td>'.$i->getBatch->name.'</td>
                </tr>';
            }
            $html .= '</tbody></table>';
            return response()->json(['html' => $html]);
    }

    public function subjectAssignStore(Request $request){
        $info = $request->validate([
            'teacher' => 'required',
            'subject' => 'required',
            'batch' => 'required',
            'trimester' => 'required',
        ]);

        $is_exist = TeacherSubjectAssign::where($info)
            ->where('id', '!=', $request->row_id)
            ->first();

        if($is_exist){
            return response()->json(['message' => 'Already Assigned'], 421);
        }else{
            TeacherSubjectAssign::create($info);
            return response()->json(['message' => 'Teacher Course Assigned', 'redirectTo' => 'close', 'call' => 'loadData', 'description'=>'', 'timer'=>500]);
        }
    }
}
