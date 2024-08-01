<?php

declare(strict_types=1);

use Symfony\Component\Process\Process;

require dirname(__DIR__).'/vendor/autoload.php';

// Ensure that phpunit is installed :/
$process = new Process([__DIR__.'/phpunit', '--help']);
$process->mustRun();

require __DIR__.'/.phpunit/vendor/autoload.php';
