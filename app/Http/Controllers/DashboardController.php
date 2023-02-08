<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Trimester;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function dashboard() {
        $data['trimester'] = Trimester::where('start', '<=', date('Y-m-d'))
            ->where('end', '>=', date('Y-m-d'))
            ->first();
        $data['batches'] = Batch::count('id');
        $data['teacher'] = User::where('user_type', 2)->count('id');
        $data['student'] = Student::count('id');
        $data['subject'] = Subject::count('id');
        return view('welcome', $data);
    }
}
