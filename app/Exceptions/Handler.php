<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\DB;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            // dd($e);
            // dd($e->getFile());

            // $data = FirewatchError::create([
            //     'error_message' => 'message',
            //     'error_line_no' => 1,
            //     'error_file_name' => 'dummy',
            //     'error_code' => 'dummy',
            //     'error_stack_trace' => 'dummy',
            //     'occurence_count' => 1,
            //     'request_url' => 'dummy',
            //     'request_method' => 'dummy',
            // ]);

            $data = DB::table('firewatch_errors')->insert([
                'error_message' => $e->getMessage(),
                'error_line_no' => $e->getLine(),
                'error_file_name' => $e->getFile(),
                'error_code' => $e->getCode(),
                'error_stack_trace' => 'dummy',
                'occurence_count' => 1,
                'request_url' => 'dummy',
                'request_method' => 'dummy',
            ]);

            dd($data);

        });

    }

}
