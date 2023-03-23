<?php

use App\Models\Trimester;

function requestSuccess($message = '', $description = '', $redirectTo = 'closeAndModalHide', $timer = null, $call = '', $buttonShow = false)
{
    return (object)[
        'buttonShow' => $buttonShow,
        'timer' => $timer,
        'message' => $message,
        'description' => $description,
        'redirectTo' => $redirectTo,
        'call' => $call
    ];
}

function active_user()
{
    $user_id = auth()->guard('auth')->user()->id ?? null;
    return $user_id;
}

function user_info(){
    return auth()->guard('auth')->user();
}

function getTeacherDesignation($type=null){
    $arr = [
        1 => 'Professor',
        2 => 'Assistant Professor',
        3 => 'Senior Lecturer',
        4 => 'Lecturer',
        5 => 'Teaching Assistant',
    ];
    if($type){
        return $arr[$type];
    }else{
        return $arr;
    }
}

function getMarkDistrbution($type=null){
    $m = ['1'=>'Theory', '2' => 'Sessional'];
    if($type) return $m[$type];
    else return $m;
}

function currTrimester($all_info=null){
    $info = Trimester::where('start', '<=', date('Y-m-d'))
        ->where('end', '>=', date('Y-m-d'))
        ->first();
    if($all_info == 1){
        return $info;
    }else{
        return $info->id ?? null;
    }
}

function getMarkDistribution($type){
    if($type == 1){ // theory
        return [
            1 => 'Mid Assignment (5)',
            2 => 'Mid CT (5)',
            3 => 'Mid Exam (30)',
            4 => 'Final Assignment (5)',
            5 => 'Final CT (5)',
            6 => 'Final Exam (40)',
            7 => 'Attandance (10)',
        ];
    }
    if($type == 2){ // sessional
        return [
            1 => 'Mid Class Performance (10)',
            2 => 'Mid Report (10)',
            3 => 'Mid Quiz (15)',
            4 => 'Mid Viva (10)',
            5 => 'Final Class Performance (10)',
            6 => 'Final Report (10)',
            7 => 'Final Quiz (15)',
            8 => 'Final Viva (10)',
            9 => 'Attandance (10)',
        ];
    }
}
