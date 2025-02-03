<?php
require_once "curl.php";
class Bot extends Curl
{
    public $token, $api_url, $description, $text;
    public $option01, $option02, $option03, $option04;
    public $provider, $payload;
    public function __construct($token)
    {
        $this->token = $token;
        $this->api_url = "https://tapi.bale.ai/bot" . $this->token;
        $this->option01 = "";
        $this->option02 = "";
        $this->option03 = "";
        $this->option04 = "";
        $this->text = "";
        $this->provider = "5859831090907071";
        $this->payload = "1000";
        //print_r(file_get_contents($this->api_url));
    }

    public function send_message($chat_id, $text, $reply_to = "", $reply_markup = "")
    {
        //$info = $this->get_update();
        $this->text = $text;
        $send = $this->send_curl_request($this->api_url . "/sendMessage", array(
            "chat_id" => $chat_id,
            "text" => $text,
            "reply_markup" => json_encode(
                [
                    "keyboard" => [
                        [['text' => $this->option01], ['text' => $this->option02]],
                    ],
                    "one_time_keyboard" => true
                ]
            )
        ));
        return json_decode($send, true);
    }

    public function get_last_message()
    {
        try {
            $updates = json_decode($this->get_update(), true);
            //print_r(end($updates['result']));
            $end_update = end($updates['result']);
            if(count($end_update) > 0 && $end_update['message']['chat']['title'] == "رسید پرداخت" && count($end_update['message']['successful_payment']) > 0){
                //echo "<pre>";
                return $end_update;
                //echo "</pre>";
            }
            return array(
                "message" => $end_update['message']['text'],
                "chat_id" => $end_update['message']['chat']['id']
            );
        } catch (Exception $e) {
            return $e;
        }
    }


    public function get_update()
    {
        return $this->send_curl_request($this->api_url . '/getUpdates');
    }

    public function sendInvoice($chat_id, $title, $description, $prices, $photo_url=""){
        return $this->send_curl_request($this->api_url . "/sendInvoice", array(
            "chat_id" => $chat_id,
            "title" => $title,
            "description" => $description,
            "payload" => $this->payload,
            "provider_token" => $this->provider,
            "prices" => $prices,
            "photo_url" => $photo_url
        ));
    }

    public function set_webhook($url){
        return $this->send_curl_request($this->api_url . "/setWebhook", ["url" => $url]);
    }

}


