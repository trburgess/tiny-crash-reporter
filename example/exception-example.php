<?php

require_once 'vendor/autoload.php';

\TinyCrashReporter\Handler::register();

throw new \Exception('This is the Exception :)');
