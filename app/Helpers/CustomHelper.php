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
