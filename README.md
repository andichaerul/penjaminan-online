# Penjaminan Online PHP SDK

SDK PHP sederhana untuk mengirim log permohonan ke API Penjaminan Online.

## Install

```bash
composer require andichaerul/penjaminan-online
```

## Kebutuhan

- PHP 8.1+ (karena menggunakan `enum`)
- Ekstensi `curl`

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
use Andichaerul\PenjaminanOnline\LogPermohonan\LogPermohonanProsesEnum;

$isSuccess = LogPermohonan::create(
    1,
    null,
    'brins',
    'insurance',
    null,
    null,
    null,
    1,
    LogPermohonanProsesEnum::permohonan_disubmit_prinsipal,
    '0.0.0.0'
);

var_dump($isSuccess); // bool(true)
```

## API

Method utama:

```php
LogPermohonan::create(
    int $permohonanId,
    ?string $nomorDokumen,
    ?string $companyCode,
    'insurance'|'bank' $type,
    ?array $payload,
    ?array $beforeValues,
    ?array $afterValues,
    ?int $userId,
    LogPermohonanProsesEnum $proses,
    ?string $ipAddress
): bool
```

### Keterangan Parameter

- `permohonanId`: ID permohonan.
- `nomorDokumen`: nomor dokumen terkait (opsional).
- `companyCode`: kode perusahaan (opsional).
- `type`: tipe penjaminan (`insurance` atau `bank`).
- `payload`: data tambahan request (opsional).
- `beforeValues`: snapshot data sebelum perubahan (opsional).
- `afterValues`: snapshot data sesudah perubahan (opsional).
- `userId`: ID user pelaku proses (opsional).
- `proses`: status proses dari enum `LogPermohonanProsesEnum`.
- `ipAddress`: alamat IP sumber aksi (opsional).

### Return Value

- `true` jika API mengembalikan status sukses.
- Throw `Exception` jika API key tidak tersedia atau respons API gagal.

## Daftar Nilai Proses (Enum)

Nilai enum yang tersedia saat ini:

- `permohonan_disubmit_prinsipal`
- `permohonan_ditolak_oleh_underwriter_asuransi`
- `permohonan_menunggu_verifikasi_underwriter_asuransi`
- `permohonan_diterima_diisi_rincian_biaya_oleh_underwriter_asuransi`
- `draft_surat_jaminan_diterima_oleh_principal`
- `meterai_diterima`
- `request_digital_sign_dikirim`
- `request_digital_sign_diterima`
- `request_tera_dikirim`
- `surat_jaminan_diterbitkan`
- `permohonan_menunggu_verifikasi_pemutus`
- `draft_surat_jaminan_diterima_oleh_pemutus`
- `perpanjangan_diterima_diisi_rincian_biaya_oleh_underwriter_asuransi`
- `permohonan_diterima_oleh_marketing`
- `perpanjangan_disubmit_prinsipal`
- `pembayaran_invoice_berhasil_dilakukan_oleh_prinsipal`
- `request_tera_diterima`
- `draft_surat_jaminan_ditolak_oleh_principal`

## Menjalankan Uji Coba Lokal

```bash
php test/log_permohonan.php
```

## Catatan

- Endpoint yang dipakai SDK saat ini: `https://api-v2.penjaminan-online.id/logs`
- Pastikan API key valid dan environment variable sudah terbaca oleh proses PHP.

## Lisensi

MIT
