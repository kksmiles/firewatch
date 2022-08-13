<?php

namespace KkSmiles\Firewatch\Services;

use KkSmiles\Firewatch\Models\FirewatchError;

class FirewatchErrorService
{
    public static function AddErrorRecord($e)
    {
        $error = FirewatchError::firstOrCreate(
            [
                'error_line_no' => $e->getLine(),
                'error_file_name' => $e->getFile(),
                'request_url' => request()->path(),
                'request_method' => request()->method()
            ],
            [
                'error_message' => $e->getMessage(),
                'error_code' => $e->getCode(),
                'error_stack_trace' => 'dummy',
                'occurence_count' => 0
            ]
        );

        if ($error->solved_date != null ) {
            $error->solved_date = null;
        }
        $error->occurence_count += 1;
        $error->update();

        return $error;
    }
}
