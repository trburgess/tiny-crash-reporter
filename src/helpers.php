<?php
namespace TinyCrashReporter;

function formatMessage($what, $why = '')
{
    return $what . ': ' . ($why ?: 'N\A') . PHP_EOL;
}
