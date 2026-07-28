<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Andichaerul\PenjaminanOnline\LogPermohonan\LogPermohonan;
use Andichaerul\PenjaminanOnline\LogPermohonan\LogPermohonanProsesEnum;

$logPermohonan = LogPermohonan::create(
    1,
    null,
    "zzzz",
    'insurance',
    [],
    [],
    [],
    1,
    LogPermohonanProsesEnum::permohonan_disubmit_prinsipal,
    1
);
echo $logPermohonan; // Output: Hello World
