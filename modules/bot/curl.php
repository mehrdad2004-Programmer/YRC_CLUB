<?php  
    class Curl{

        public function send_curl_request($url, $params = []){
            $ch = curl_init(); 
            curl_setopt($ch, CURLOPT_POST, false);
            curl_setopt($ch, CURLOPT_URL, $url . "?" . http_build_query($params));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $output = curl_exec($ch);
            curl_close($ch);  
            return $output;
        }
    }