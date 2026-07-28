<?php

namespace Andichaerul\PenjaminanOnline\LogPermohonan;

enum LogPermohonanProsesEnum: string
{
    case permohonan_disubmit_prinsipal = "permohonan_disubmit_prinsipal";
    case permohonan_ditolak_oleh_underwriter_asuransi = "permohonan_ditolak_oleh_underwriter_asuransi";
    case permohonan_menunggu_verifikasi_underwriter_asuransi = "permohonan_menunggu_verifikasi_underwriter_asuransi";
    case permohonan_diterima_diisi_rincian_biaya_oleh_underwriter_asuransi = "permohonan_diterima_diisi_rincian_biaya_oleh_underwriter_asuransi";
    case draft_surat_jaminan_diterima_oleh_principal = "draft_surat_jaminan_diterima_oleh_principal";
    case meterai_diterima = "meterai_diterima";
    case request_digital_sign_dikirim = "request_digital_sign_dikirim";
    case request_digital_sign_diterima = "request_digital_sign_diterima";
    case request_tera_dikirim = "request_tera_dikirim";
    case surat_jaminan_diterbitkan = "surat_jaminan_diterbitkan";
    case permohonan_menunggu_verifikasi_pemutus = "permohonan_menunggu_verifikasi_pemutus";
    case draft_surat_jaminan_diterima_oleh_pemutus = "draft_surat_jaminan_diterima_oleh_pemutus";
    case perpanjangan_diterima_diisi_rincian_biaya_oleh_underwriter_asuransi = "perpanjangan_diterima_diisi_rincian_biaya_oleh_underwriter_asuransi";
    case permohonan_diterima_oleh_marketing = "permohonan_diterima_oleh_marketing";
    case perpanjangan_disubmit_prinsipal = "perpanjangan_disubmit_prinsipal";
    case pembayaran_invoice_berhasil_dilakukan_oleh_prinsipal = "pembayaran_invoice_berhasil_dilakukan_oleh_prinsipal";
    case request_tera_diterima = "request_tera_diterima";
    case draft_surat_jaminan_ditolak_oleh_principa = "draft_surat_jaminan_ditolak_oleh_principal";
}
