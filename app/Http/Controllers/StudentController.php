<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Student;
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
}
