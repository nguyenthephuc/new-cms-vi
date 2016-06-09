<?php
class Api {

    public static function getCoordinates($address)
    {
        if(empty($address)) return false;
        $address = str_replace(" ", "+", $address);
        $url = "http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);
        curl_close($ch);
        $response_a = json_decode($response);
        $lat = $response_a->results[0]->geometry->location->lat;
        $long = $response_a->results[0]->geometry->location->lng;
        $result = array($lat, $long);
        return $result;
    }

    public static function getPostal($code)
    {
        if(!$code) return false;
        $file = PUBLIC_PATH.'admin/js/zipcode/postal.tsv';
        if(!file_exists($file)) View::show404("'$file' not found!");
        $handle = @fopen($file, "r");
        if ($handle) {
            while ( ($line = fgets($handle)) ) {
                $data = explode("\t", $line);
                if($data[0] === $code){
                    return $data;
                }
            }
            fclose($handle);
        } else {
            View::show404("'$file' cannot open!");
        }
    }
}