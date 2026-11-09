<?php

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/init.php';

use Andichaerul\PenjaminanOnline\LogPermohonan\LogPermohonan;

$logPermohonan = LogPermohonan::get(permohonanId: 399);
echo json_encode($logPermohonan['data'][0]['createdAt'] ?? 'kosong');
