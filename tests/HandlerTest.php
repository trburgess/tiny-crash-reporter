<?php
namespace TintCrashReporter\Tests;

use Exception;

class HandlerTest extends \PHPUnit_Framework_TestCase
{
    const ERROR_MESSAGE = 'Error Message';
    protected $handler;

    protected function setUp()
    {
        $this->handler = Handler::register();
    }

    public function testErrorHandler()
    {
        $this->handler->errorHandler(E_WARNING, self::ERROR_MESSAGE, 'errorfile.php', 1);
    }

    public function testExceptionHandler()
    {
        $this->handler->exceptionHandler(new Exception(self::ERROR_MESSAGE));
    }
}