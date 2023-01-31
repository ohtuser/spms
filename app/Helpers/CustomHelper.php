<?php

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
