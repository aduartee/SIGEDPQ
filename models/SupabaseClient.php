<?php
class SupabaseClient {
    private $url;
    private $key;

    public function __construct($url, $key) {
        $this->url = $url;
        $this->key = $key;
    }

    private function request($endpoint, $method = "GET", $data = null) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "$this->url/rest/v1/$endpoint");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "apikey: $this->key",
            "Authorization: Bearer $this->key",
            "Content-Type: application/json",
            "Prefer: return=representation"
        ]);

        if ($method === "POST" || $method === "PUT" || $method === "DELETE") {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            error_log('cURL error: ' . curl_error($ch));
        }

        error_log('Request Method: ' . $method);
        error_log('Request URL: ' . "$this->url/rest/v1/$endpoint");
        error_log('Request Data: ' . json_encode($data));
        error_log('Response: ' . $response);

        curl_close($ch);

        return json_decode($response, true);
    }

    public function get($endpoint) {
        return $this->request($endpoint, "GET");
    }

    public function post($endpoint, $data) {
        return $this->request($endpoint, "POST", $data);
    }

    public function put($endpoint, $data) {
        return $this->request($endpoint, "PUT", $data);
    }
}