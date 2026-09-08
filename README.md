# Penjaminan Online PHP SDK

SDK PHP sederhana untuk mengirim log permohonan ke API Penjaminan Online.

## Install

```bash
composer require andichaerul/penjaminan-online
```

## Kebutuhan

- PHP yang kompatibel dengan kode SDK saat ini.
- Ekstensi PHP `curl`.

## Konfigurasi

Set environment variable berikut sebelum memanggil SDK:

```bash
export PENJAMINAN_ONLINE_LOG_PERMOHONAN_API_KEY="your-api-key"
```

## Contoh Penggunaan

```php
<?php

require_once __DIR__ . '/vendor/autoload.php';

use Andichaerul\PenjaminanOnline\LogPermohonan\LogPermohonan;

$isSuccess = LogPermohonan::create([
    'permohonanId' => 123,
    'nomorDokumen' => 'ABC123',
    'companyCode' => 'brins',
    'type' => 'insurance',
    'payload' => json_encode(['key' => 'value']),
    'beforeValues' => json_encode(['status' => 'draft']),
    'afterValues' => json_encode(['status' => 'submitted']),
    'userId' => 456,
    'proses' => 'permohonan_disubmit_prinsipal',
    'ipAddress' => '0.0.0.0',
]);

var_dump($isSuccess); // bool(true) jika API mengembalikan status true
```

## API

Method utama:

```php
LogPermohonan::create(array $datas): bool
```

Parameter yang diterima melalui `$datas`. Semua key berikut harus tersedia; nilai dapat `null` jika ditandai `string|null` atau `int|null`.

```php
[
    'permohonanId' => int,
    'nomorDokumen' => string|null,
    'companyCode' => string|null,
    'type' => 'insurance'|'bank',
    'payload' => string|null, // string JSON jika diperlukan
    'beforeValues' => string|null, // string JSON jika diperlukan
    'afterValues' => string|null, // string JSON jika diperlukan
    'userId' => int|null,
    'proses' => string,
    'ipAddress' => string|null,
]
```

### Keterangan Parameter

- `permohonanId`: ID permohonan.
- `nomorDokumen`: nomor dokumen terkait (opsional).
- `companyCode`: kode perusahaan (opsional).
- `type`: tipe penjaminan; nilai yang didokumentasikan adalah `insurance` atau `bank`.
- `payload`: data tambahan request dalam bentuk string JSON (opsional).
- `beforeValues`: snapshot data sebelum perubahan dalam bentuk string JSON (opsional).
- `afterValues`: snapshot data sesudah perubahan dalam bentuk string JSON (opsional).
- `userId`: ID user pelaku proses (opsional).
- `proses`: nama proses dalam bentuk string. Method `create()` tidak melakukan validasi terhadap daftar enum.
- `ipAddress`: alamat IP sumber aksi (opsional).

### Return Value

- `true` jika API mengembalikan status sukses.
- Throw `Exception` jika API key tidak tersedia atau respons API gagal.

## Menjalankan Uji Coba Lokal

```bash
php test/log_permohonan.php
```

Script tersebut memuat `test/init.php`, lalu mengirim request sungguhan ke API. Pastikan API key pada konfigurasi lokal sudah valid.

## Catatan

- Endpoint yang dipakai SDK saat ini: `https://api-v2.penjaminan-online.id/logs`
- Pastikan API key valid dan environment variable sudah terbaca oleh proses PHP.
- Jika API key tidak tersedia, SDK melempar `Exception`.
- Jika cURL gagal atau API tidak mengembalikan `{"status": true}`, SDK melempar `Exception` atau menghentikan proses dengan pesan error cURL.

## Lisensi

MIT
