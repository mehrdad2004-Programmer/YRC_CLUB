<?php
//adding authorization
require_once __DIR__ . "/middleware/authorization.php";
require_once __DIR__ . "/middleware/sanitize.php";

?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>اطلاع رسانی</title>
    <link rel="stylesheet" href="statics/css/bootstrap.min.css">
    <link rel="stylesheet" href="statics/css/style.css">
</head>
<body>
    <?php
    //including header
    require_once "components/header.php";
    ?>
    <?php

    $db = new Database();
    $token = $db->read('bot_token', ['title' => "main"])[0]['token'];
    $rec = $db->read('bot');
    $bot = new Bot($token);

    $signature = $user['fname'] . ' ' . $user['lname'] . " - " . $user['semat'];


    if(isset($_POST['submit']) && isset($_POST['text']) && $_POST['text'] != ""){
        $flag = true;
        foreach($rec as $item){
            $send = $bot->send_message($item['chat_id'], $_POST['text'] . "\n$signature - " . jdate("Y/m/d"));
            if(!$send['ok']){
                $flag = false;
            }
        }
        if($flag){
            echo "<div class='alert container mt-3 alert-success alert-dismissible fade show' role='alert'>
                        با موفقیت ارسال شد
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
        }else{
            echo "<div class='alert container mt-3 alert-danger alert-dismissible fade show' role='alert'>
                        خطا در عملیات مجدد تلاش کنید
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
        }
    }


?>
    <div class="container mt-3">
        <h3 class="text-center">اطلاع رسانی</h3>
    </div>

    <div class="container mt-3">
        <div class="container text-center">
            از طریق این صفحه می توانید به هر شخص که ربات شما را فعال کرده و دنبال می کند در پیام رسان بله از طریق ربات به صورت جمعی اطلاع رسانی انجام دهید
        </div>
        <form method="POST">
            <div class="container mt-3">
                <textarea class="container" name="text" style="height: 200px; text-align: right"></textarea>
            </div>
            <div class="container mt-3 text-center">
                <input type="submit" class="btn btn-primary" name="submit" value="ارسال">
            </div>
        </form>
    </div>
    <?php
    //including footer
    require_once "components/footer.php";
    ?>
    <script src="statics/js/bootstrap.bundle.min.js"></script>
</body>
</html>