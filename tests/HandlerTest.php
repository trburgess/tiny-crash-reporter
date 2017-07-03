<?php
namespace TintCrashReporter\Tests;

use Exception;
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
        $this->expectOutputString($this->formatMessage(E_WARNING, self::ERROR_MESSAGE));
        $this->handler->errorHandler(
            E_WARNING,
            self::ERROR_MESSAGE,
            'errorfile.php',
            1
        );
    }

    public function testExceptionHandler()
    {
        $this->expectOutputString($this->formatMessage(Exception::class, self::ERROR_MESSAGE));
        $this->handler->exceptionHandler(new Exception(self::ERROR_MESSAGE));
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
