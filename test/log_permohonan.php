<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Andichaerul\PenjaminanOnline\LogPermohonan\LogPermohonan;

$logPermohonan = LogPermohonan::create();
echo $logPermohonan; // Output: Hello World
