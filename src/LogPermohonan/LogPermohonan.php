<?php

namespace Andichaerul\PenjaminanOnline\LogPermohonan;

class LogPermohonan
{
    /**
     * @return string
     */
    private static function getXApiKey()
    {
        $xApiKey = getenv('PENJAMINAN_ONLINE_LOG_PERMOHONAN_API_KEY');
        if (is_string($xApiKey)) {
            return $xApiKey;
        } else {
            throw new \Exception('PENJAMINAN_ONLINE_LOG_PERMOHONAN_API_KEY environment variable is not set');
        }
    }

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
        $xApiKey = self::getXApiKey();
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
            "host" => $_SERVER['HTTP_HOST'] ?? null,
        ];

        $ch = curl_init($url);
        if ($ch === false) {
            throw new \Exception("Failed to initialize cURL");
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            $error = 'cURL Error: ' . curl_error($ch);
            throw new \Exception($error);
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

    /**
     * @param int $permohonanId
     * @return array{status:bool, message?: string|null, data?: list<mixed>}|null
     */
    public static function get($permohonanId)
    {
        $xApiKey = self::getXApiKey();
        $url = 'https://api-v2.penjaminan-online.id/logs';
        $headers = [
            "X-API-Key: $xApiKey",
            'Content-Type: application/json',
            'Accept: application/json',
        ];

        $curl = curl_init();
        if ($curl === false) {
            throw new \Exception("Failed to initialize cURL :47570");
        }

        $params = [
            "permohonanId" => $permohonanId,
        ];

        curl_setopt_array($curl, [
            CURLOPT_URL => $url . '?' . http_build_query($params),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPGET => true,
            CURLOPT_HTTPHEADER => $headers,
        ]);

        /** @var string|false */
        $response = curl_exec($curl);

        if (curl_errno($curl)) {
            $error = 'cURL Error: ' . curl_error($curl);
            throw new \Exception($error);
        }


        if ($response === false) {
            throw new \Exception(curl_error($curl));
        }


        /** @var array{status:bool, message?: string|null, data?: list<mixed>} */
        $data = json_decode($response, true);

        // Response OK
        if (isset($data['status']) && $data['status'] === true) {
            return $data;
        }

        // Response not OK
        $resStr  = $response;
        throw new \Exception("Failed to create log permohonan. Response: $resStr");
    }
}
