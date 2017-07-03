<?php
namespace TinyCrashReporter;

class Handler
{
    /**
     * @return Handler
     */
    public static function register()
    {
        $handler = new static;
        set_error_handler([$handler, 'errorHandler']);
        set_exception_handler([$handler, 'exceptionHandler']);

        return $handler;
    }

    /**
     * @param $errorNumber
     * @param $errorString
     * @param string $errorFile
     * @param int $errorLine
     * @return bool
     */
    public function errorHandler(
        $errorNumber,
        $errorString,
        $errorFile = '',
        $errorLine = 0
    ) {
        print $this->formatMessage($errorNumber, $errorString);
        // prevent default PHP error handler from processing error (based on requirements)
        return true;
    }

    /**
     * Exception handler callback.
     *
     * @param \Throwable|\Exception $exception the exception was was thrown
     * \Throwable PHP Version >= 7
     * \Exception PHP Version <= 5.6
     *
     * @return void
     */
    public function exceptionHandler($exception)
    {
        print $this->formatMessage(get_class($exception), $exception->getMessage());
    }

    /**
     * @param $what
     * @param $why
     * @return string
     */
    protected function formatMessage($what, $why)
    {
        return $what . ': ' . $why . PHP_EOL;
    }
}
