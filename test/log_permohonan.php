<?php

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/init.php';

use Andichaerul\PenjaminanOnline\LogPermohonan\LogPermohonan;

$logPermohonan = LogPermohonan::create([
    "permohonanId" => 123,
    "nomorDokumen" => "ABC123",
    "companyCode" => "brins",
    "type" => "insurance",
    "payload" => "ini json",
    "beforeValues" => "ini json",
    "afterValues" => "ini json",
    "userId" => 456,
    "proses" => "menunggu",
    "ipAddress" => "0.0.0.0"
]);
echo $logPermohonan; // Output: Hello World
