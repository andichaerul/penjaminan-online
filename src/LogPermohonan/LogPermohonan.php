<?php

namespace Andichaerul\PenjaminanOnline\LogPermohonan;

use Andichaerul\PenjaminanOnline\LogPermohonan\LogPermohonanProsesEnum;


class LogPermohonan
{
    /**
     * @param int $permohonanId
     * @param string|null $nomorDokumen
     * @param string|null $companyCode
     * @param "insurance"|"bank" $type
     * @param array|null $payload
     * @param array|null $beforeValues
     * @param array|null $afterValues
     * @param int|null $userId
     * @param LogPermohonanProsesEnum $proses
     * @param string|null $ipAddress
     * @return bool
     */
    public static function create($permohonanId, $nomorDokumen, $companyCode, $type, $payload, $beforeValues, $afterValues, $userId, $proses, $ipAddress,)
    {

        $xApiKey = getenv('PENJAMINAN_ONLINE_LOG_PERMOHONAN_API_KEY');
        if ($xApiKey === false) {
            throw new \Exception('PENJAMINAN_ONLINE_LOG_PERMOHONAN_API_KEY environment variable is not set');
        }

        $url = 'https://api-v2.penjaminan-online.id/logs';
        $headers = [
            'X-API-Key: ' . $xApiKey,
            // 'Content-Type: application/json',
            // 'Accept: application/json',
        ];

        $data = [
            "permohonanId" => $permohonanId,
            "nomorDokumen" => $nomorDokumen,
            "companyCode" => $companyCode,
            "type" => $type,
            "payload" => $payload,
            "beforeValues" => $beforeValues,
            "afterValues" => $afterValues,
            "userId" => $userId,
            "proses" => $proses,
            "ipAddress" => $ipAddress,
        ];

        $ch = curl_init($url);
        if ($ch === false) {
            die('Failed to initialize cURL');
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            die('cURL Error: ' . curl_error($ch));
        }


        if (is_string($response)) {
            $jsonDecode = json_decode($response, true);
            if (isset($jsonDecode['status']) && $jsonDecode['status'] === true) {
                return true;
            }
        }

        $resStr  = (string) $response;
        throw new \Exception("Failed to create log permohonan. Response: $resStr");
    }
}
