<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Trimester;
use App\Traits\CommonList;
use Illuminate\Http\Request;

class CommonTaskController extends Controller
{
    use CommonList;
    public function trimester(Request $request){
        if($request->ajax()){
            $data = Trimester::paginate(20);
            $body = $this->trimesterList($data,$data->currentPage(),$data->perPage());
            $paginate = $data->appends(request()->query())->links('pagination::bootstrap-4');
            $paginate = $paginate->render();
            return response()->json(['body'=>$body, 'paginate'=>$paginate]);
        }
        return view('common.trimester');
    }

    public function batch(Request $request){
        if($request->ajax()){
            $data = Batch::paginate(20);
            $body = $this->batchList($data,$data->currentPage(),$data->perPage());
            $paginate = $data->appends(request()->query())->links('pagination::bootstrap-4');
            $paginate = $paginate->render();
            return response()->json(['body'=>$body, 'paginate'=>$paginate]);
        }
        return view('common.batch');
    }
}
