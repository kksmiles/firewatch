<?php
namespace KkSmiles\Firewatch;

use Throwable;
use Illuminate\Http\Request;
use KkSmiles\Firewatch\TelegramMessageSender;
use Illuminate\Contracts\Debug\ExceptionHandler;
use KkSmiles\Firewatch\Services\FirewatchErrorService;

/**
 * The exception handler to override the default.
 *
 */
class FirewatchExceptionHandler implements ExceptionHandler
{
    /**
     * The default Laravel exception handler.
     *
     * @var \Illuminate\Contracts\Debug\ExceptionHandler
     */
    protected $defaultHandler;

    /**
     * Set the dependencies.
     *
     * @param \Illuminate\Contracts\Debug\ExceptionHandler $defaultHandler
     */
    public function __construct(ExceptionHandler $defaultHandler)
    {
        $this->defaultHandler = $defaultHandler;
    }

    /**
     * Report or log an exception.
     *
     * @param \Throwable $e
     * @return mixed
     *
     * @throws \Throwable
     */
    public function report(Throwable $e)
    {
        $error = FirewatchErrorService::AddErrorRecord($e);

        if (in_array('telegram', config('firewatch.notify_to'))) {
            TelegramMessageSender::sendMessage($e);
        }
        $this->defaultHandler->report($e);
    }

    /**
     * Render an exception into a response.
     *
     * @param \Illuminate\Http\Request  $request
     * @param \Throwable $e
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Throwable $e)
    {
        return $this->defaultHandler->render($request, $e);
    }

    /**
     * Render an exception to the console.
     *
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     * @param \Throwable $e
     * @return mixed
     */
    public function renderForConsole($output, Throwable $e)
    {
        $this->defaultHandler->renderForConsole($output, $e);
    }

    /**
     * Determine if the exception should be reported.
     *
     * @param \Throwable $e
     * @return bool
     */
    public function shouldReport(Throwable $e)
    {
        return $this->defaultHandler->shouldReport($e);
    }
}
