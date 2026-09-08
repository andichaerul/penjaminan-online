<?php

namespace Andichaerul\PenjaminanOnline\LogPermohonan;




class LogPermohonan
{
    /**
     * @param array{
     *    permohonanId: int,
     *    nomorDokumen: string|null,
     *    companyCode: string|null,
     *    type: "insurance"|"bank",
     *    payload: string|null, // json string
     *    beforeValues: string|null, // json string
     *    afterValues: string|null, // json string
     *    userId: int|null,
     *    proses: string,
     *    ipAddress: string|null
     * } $datas
     * @return bool
     */
    public static function create($datas)
    {

        $xApiKey = getenv('PENJAMINAN_ONLINE_LOG_PERMOHONAN_API_KEY');
        if ($xApiKey === false) {
            throw new \Exception('PENJAMINAN_ONLINE_LOG_PERMOHONAN_API_KEY environment variable is not set');
        }

        $url = 'https://api-v2.penjaminan-online.id/logs';
        $headers = [
            "X-API-Key: $xApiKey",
            'Content-Type: application/json',
            'Accept: application/json',
        ];

        $data = [
            "permohonanId" => $datas['permohonanId'],
            "nomorDokumen" => $datas['nomorDokumen'],
            "companyCode" => $datas['companyCode'],
            "type" => $datas['type'],
            "payload" => $datas['payload'],
            "beforeValues" => $datas['beforeValues'],
            "afterValues" => $datas['afterValues'],
            "userId" => $datas['userId'],
            "proses" => $datas['proses'],
            "ipAddress" => $datas['ipAddress'],
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
