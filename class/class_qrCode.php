<?php

class class_qrCode {

    public $cht;
    public $apiurl;

    public function __construct() {
        $this->cht = "qr";
        $this->apiurl = "https://chart.googleapis.com/chart";
    }

    public function getQrCode(
            $data,
            $width,
            $height,
            $output_encoding = false,
            $error_correction_level = false
    ) {
        $data = urlencode($data);

        $url = $this->apiurl .
                "?cht=" .
                $this->cht .
                "&chl=" .
                $data .
                "&chs=" .
                $width .
                "x" .
                $height;

        if ($output_encoding) {
            $url .= "&choe=" . $output_encoding;
        }
        if ($error_correction_level) {
            $url .= "&chld=" . $error_correction_level;
        }

        return $url;
    }

    public function postQrCode(
        $data,
        $width,
        $height,
        $output_encoding = false,
        $error_correction_level = false
    ) {
        $data = urlencode($data);

        $parameterList = [
            "cht" => $this->cht,
            "chs" => $width . "x" . $height,
            "chl" => $data,
        ];

        if ($output_encoding) {
            $parameterList["choe"] = $output_encoding;
        }

        if ($error_correction_level) {
            $parameterList["chld"] = $error_correction_level;
        }

        $content = http_build_query($parameterList);

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $this->apiurl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $content,
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/x-www-form-urlencoded",
            ],
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }
}
