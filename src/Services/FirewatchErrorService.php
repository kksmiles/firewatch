<?php

namespace KkSmiles\Firewatch\Services;

use KkSmiles\Firewatch\Models\FirewatchError;

class FirewatchErrorService
{
    public static function AddErrorRecord($e)
    {
        // TODO - replace dummy data
        // TODO - if same error exists, occurence_count + 1
        // TODO - remove temporary data

        $error_line_no = $e->getLine();
        $error_file_name = $e->getFile();
        $request_url = request()->path();
        $request_method = request()->method();

        $error = FirewatchError::firstOrCreate(
            [
                'error_line_no' => $error_line_no,
                'error_file_name' => $error_file_name,
                'request_url' => $request_url,
                'request_method' => $request_method
            ],
            [
                'error_message' => $e->getMessage(),
                'error_code' => $e->getCode(),
                'error_stack_trace' => 'dummy',
                'occurence_count' => 0
            ]
        );
        $error->occurence_count += 1;
        $error->update();

        return $error;
    }
}
