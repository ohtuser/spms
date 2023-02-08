<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\User;
use App\Traits\CommonList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SubjectController extends Controller
{
    use CommonList;
    public function subject(Request $request){
        if($request->ajax()){
            $data = Subject::paginate(20);
            $body = $this->subjectList($data,$data->currentPage(),$data->perPage());
            $paginate = $data->appends(request()->query())->links('pagination::bootstrap-4');
            $paginate = $paginate->render();
            return response()->json(['body'=>$body, 'paginate'=>$paginate]);
        }
        return view('subject.index');
    }

    public function store(Request $request){
        $insert_data = $request->validate([
            'name' => 'required',
            'code' => 'required',
            'credit' => 'required'
        ]);

        $insert_data['description'] = $request->description;
        // dd($insert_data);

        if($request->row_id){
            Subject::find($request->row_id)->update($insert_data);
        }else{
            Subject::create($insert_data);
        }
        return response()->json(['message' => 'Subject Created/Updated', 'redirectTo' => 'close', 'call' => 'loadData', 'description'=>'', 'timer'=>500]);
    }

    public function edit(Request $request){
        $info = Subject::findOrFail($request->id);
        return response()->json(['info'=>$info]);
    }
}
