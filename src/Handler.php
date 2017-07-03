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
     * @param $errorCode
     * @param $errorString
     * @param string $errorFile
     * @param int $errorLine
     * @return bool
     */
    public function errorHandler(
        $errorCode,
        $errorString,
        $errorFile = '',
        $errorLine = 0
    ) {
        if ($this->shouldIgnoreErrorCode($errorCode)) {
            return false;
        }

        print formatMessage(
            $this->friendlyErrorType($errorCode),
            $errorString
        );

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
        print formatMessage(get_class($exception), $exception->getMessage());
    }

    /**
     * @param $type
     * @return string
     */
    protected function friendlyErrorType($type)
    {
        switch ($type) {
            case E_ERROR: // 1 //
                return 'E_ERROR';
            case E_WARNING: // 2 //
                return 'E_WARNING';
            case E_PARSE: // 4 //
                return 'E_PARSE';
            case E_NOTICE: // 8 //
                return 'E_NOTICE';
            case E_CORE_ERROR: // 16 //
                return 'E_CORE_ERROR';
            case E_CORE_WARNING: // 32 //
                return 'E_CORE_WARNING';
            case E_COMPILE_ERROR: // 64 //
                return 'E_COMPILE_ERROR';
            case E_COMPILE_WARNING: // 128 //
                return 'E_COMPILE_WARNING';
            case E_USER_ERROR: // 256 //
                return 'E_USER_ERROR';
            case E_USER_WARNING: // 512 //
                return 'E_USER_WARNING';
            case E_USER_NOTICE: // 1024 //
                return 'E_USER_NOTICE';
            case E_STRICT: // 2048 //
                return 'E_STRICT';
            case E_RECOVERABLE_ERROR: // 4096 //
                return 'E_RECOVERABLE_ERROR';
            case E_DEPRECATED: // 8192 //
                return 'E_DEPRECATED';
            case E_USER_DEPRECATED: // 16384 //
                return 'E_USER_DEPRECATED';
        }

        return 'Unknown Error';
    }

    /**
     * @param $errorCode
     * @return bool
     */
    protected function shouldIgnoreErrorCode($errorCode)
    {
        return !(error_reporting() & $errorCode);
    }
}
