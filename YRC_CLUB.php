<?php
    //error_reporting(0);
    require_once __DIR__ . "/modules/bot/bot.php";
    require_once __DIR__ . "/modules/registration/registration.php";
    require_once __DIR__ . "/modules/accounting/accounting.php";
    require_once __DIR__ . "/modules/database/database.php";
    require_once __DIR__ . "/modules/jdate/jdf.php";

    header("Content-Type: application/json");

    $db = new Database();
    $bot = new Bot($db->read('bot_token', ['title' => 'main'])[0]['token']);
    $reg = new Registration();

    $acc = new Accounting();

    $tables = [
        "bot_status" => "bot",
        "courses" => "courses",
        "registration" => "registration"
    ];

    $communities = [
        "کامپیوتر",
    ];

    $last_message = $bot->get_last_message();
    //print_r($last_message['message']);
    switch ($last_message['message']){
        case "منوی اصلی":
        case "/start" :
            $user_date = $db->read($tables['bot_status'], ['chat_id' => $last_message['chat_id']]);
            print_r($user_date);
            $bot->send_message($last_message['chat_id'], "به باشگاه پژوهشگران و نخبگان جوان خوش آمدید");
            print_r($user_date);
            if(count($user_date) > 0){
                $bot->option01 = "مشاهده دوره ها";
                $bot->option02 = "منوی اصلی";
                $bot->send_message($last_message['chat_id'], "لطفا یکی از گزینه ها را انتخاب نمایید");
                $user = $db->read($tables['bot_status'], [
                    'chat_id' => $last_message['chat_id']
                ]);
                $db->update($tables['bot_status'],
                    ['status' => "0"],
                    ['chat_id' => $last_message['chat_id']]);
            }else{
                $bot->send_message($last_message['chat_id'], "برای استفاده از امکانات روبات می بایست ابتدا ثبت نام نمایید");
                $bot->send_message($last_message['chat_id'], "لطفا اطلاعات خود را مطابق فرمت ذیل وارد نمایید\nنام\nنام خانوادگی\nواحد دانشگاهی\nرشته\nشماره همراه\nشماره ملی\nشماره دانشجویی\n");
                $db->create($tables['bot_status'], [
                    "chat_id" => $last_message['chat_id'],
                    "status" => "1"
                ]);

            }
            break;

        case "مشاهده دوره ها":
            //echo "found";
            $bot->option01 = "کامپیوتر";
            $bot->option02 = "منوی اصلی";
            $bot->send_message($last_message['chat_id'], "لطفا انجمن مورد نظر را انتخاب نمایید");
            $db->update($last_message['bot_status'], ['status' => '1'], ['chat_id' => $last_message['chat_id']]);
            $bot->option01 = "کامپیوتر";
            break;
    }

    foreach($communities as $item_co){
        switch($last_message['message']){
            case $item_co:
                //  echo "found";
                $bot->option01 = "منوی اصلی";
                $data = $db->read($tables['courses'], ['comunity' => "computer"]);
                if(count($data) > 0){
                    $bot->payload = $db->read($tables['registration'], ['chat_id' => $last_message['chat_id']])[0]['st_id_no'] . "," . $data[0]['code'];
                    echo $bot->payload;
                    $text = "";
                    foreach($data as $item){
                        $text .= "نام دوره : " . $item['title'] . "\n" . "مدرس : " . $item['teacher'] .  "\n" ."توضیحات : " . $item['description']  . "\n" . "تاریخ شروع : " . $item['start'] . "\n"  . "کد دوره : " . "قیمت: " . $item['amount'] . " ریال" . "\n"  . "کد دوره : " . $item['code'];
                        $bot->sendInvoice($last_message['chat_id'], $item['title'], $text, json_encode([
                            ["label" => $item['title'], "amount" => $item['amount']]
                        ]));
                    }
                    $bot->option01 = "منوی اصلی";
                }else{
                    $bot->send_message($last_message['chat_id'], "دوره ای برای این انجمن یافت نشد");
                }

                break;
        }
    }

    //use to register new uses (not for courses)
    $status = $db->read($tables['bot_status'], ['chat_id' => $last_message['chat_id']])[0];
    echo "staus is : " . $status['status'];
    switch($status['status']){
        case "1":
            $lines = preg_split('/\r\n|\r|\n/', $last_message['message']);
            $res = $reg->register_student([
                "st_fname" => $lines[0],
                "st_lname" => $lines[1],
                "university" => $lines[2],
                "field" => $lines[3],
                "phone" => $lines[4],
                "st_id_no" => $lines[5],
                'st_code' => $lines[6],
                "date" => jdate("Y/m/d"),
                "time" => jdate("H:i:s")
            ]);
            if($res){
                $db->update($tables['bot_status'], ["status" => "0"], ["chat_id" => $last_message['chat_id']]);
                $bot->option01 = "منوی اصلی";
                $bot->send_message($last_message['chat_id'], "ثبت نام شما با موفقیت انجام شد");
            }
            break;
    }


    //storing payment info
    try{
        if(isset($last_message['message']['chat'])){
            if($last_message['message']['chat']['title'] == "رسید پرداخت"){
                $acc->set_bill([
                    "amount" => $last_message['message']['successful_payment']['total_amount'],
                    "id_no" => explode(',', $last_message['message']['successful_payment']['invoice_payload'])[0],
                    "course_code" => explode(',', $last_message['message']['successful_payment']['invoice_payload'])[1],
                    "transaction_id" => $last_message['message']['successful_payment']['provider_payment_charge_id'],
                    "date" => jdate("Y/m/d"),
                    "time" => jdate("H:i:s")
                ]);
            }

        }
    }catch (Exception $e){
        echo "something wrong";
    }


