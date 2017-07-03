<?php
namespace TintCrashReporter\Tests;

use Exception;
use function TinyCrashReporter\formatMessage;
use TinyCrashReporter\Handler;

class HandlerTest extends \PHPUnit_Framework_TestCase
{
    const ERROR_MESSAGE = 'Error Message';

    /**
     * @var Handler
     */
    protected $handler;

    protected function setUp()
    {
        $this->handler = Handler::register();
    }

    public function testErrorHandler()
    {
        $this->expectOutputString(formatMessage('E_WARNING', self::ERROR_MESSAGE));
        $this->handler->errorHandler(
            E_WARNING,
            self::ERROR_MESSAGE,
            'errorfile.php',
            1
        );
    }

    public function testExceptionHandler()
    {
        $this->expectOutputString(formatMessage(Exception::class, self::ERROR_MESSAGE));
        $this->handler->exceptionHandler(new Exception(self::ERROR_MESSAGE));
    }

    public function testExceptionHandlerWithNoMessage()
    {
        $this->expectOutputString(formatMessage(Exception::class));
        $this->handler->exceptionHandler(new Exception());
    }
}
