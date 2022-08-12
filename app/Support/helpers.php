<?php

function handle_front_exception(\Exception $e)
{
    if (env('APP_ENV') == 'local') {
        return response()->json([
            'error'       => 'error',
            'message'     => $e->getMessage(),
            'file'        => $e->getFile(),
            'code'        => $e->getCode(),
            'line'        => $e->getLine(),
            'description' => $e->getTrace()
        ], 500);

    }

    return response()->json([
        'error'   => 'error',
        'message' => __('Server Error')
    ], 500);
}

function poll_token_generator($poll, $user)
{
    return md5($poll->id . '_' . $poll->created_at . '_' . $user->id . '_' . $user->created_at);
}