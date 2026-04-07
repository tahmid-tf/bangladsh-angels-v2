<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class AamarpayGateway
{
    public function mode(): string
    {
        $mode = config('aamarpay.mode', 'sandbox');

        return in_array($mode, ['sandbox', 'live'], true) ? $mode : 'sandbox';
    }

    /**
     * Active store/signature URLs for the configured mode.
     *
     * @return array{jsonpost_url: string, trxcheck_base: string, store_id: string, signature_key: string}
     */
    public function activeConfig(): array
    {
        $mode = $this->mode();
        $cfg = config("aamarpay.{$mode}");

        if (empty($cfg['store_id']) || empty($cfg['signature_key'])) {
            throw new \RuntimeException(
                "AamarPay {$mode} credentials are not configured. Set AAMARPAY_".strtoupper($mode).'_STORE_ID and AAMARPAY_'.strtoupper($mode).'_SIGNATURE_KEY in .env.'
            );
        }

        return $cfg;
    }

    /**
     * Server-to-server verification (trxcheck). Returns decoded JSON object or null on failure.
     */
    public function verifyTransaction(string $merTxnid): ?object
    {
        if ($merTxnid === '') {
            return null;
        }

        try {
            $cfg = $this->activeConfig();
        } catch (\RuntimeException $e) {
            Log::error('AamarPay verifyTransaction: '.$e->getMessage());

            return null;
        }

        $query = http_build_query([
            'request_id' => $merTxnid,
            'store_id' => $cfg['store_id'],
            'signature_key' => $cfg['signature_key'],
            'type' => 'json',
        ], '', '&', PHP_QUERY_RFC3986);

        $url = $cfg['trxcheck_base'].'?'.$query;

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if ($err) {
            Log::error("AamarPay trxcheck cURL error: {$err}");

            return null;
        }

        Log::info('AamarPay trxcheck response (HTTP '.$httpCode.'): '.$response);

        $data = json_decode($response ?: '');

        return is_object($data) ? $data : null;
    }
}
