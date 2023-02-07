<?php

namespace App\Http\Controllers;

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
            'email' => 'required|email'
        ]);

        if(!$request->row_id){
            $request->validate([
                'password' => 'required'
            ]);
        }

        $insert_data = [
            'name' => $request->name,
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
}
