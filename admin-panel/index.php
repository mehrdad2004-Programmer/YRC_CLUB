<?php 
    //adding authorization
    require_once __DIR__ . "/middleware/authorization.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="statics/css/bootstrap.min.css">
    <link rel="stylesheet" href="statics/css/style.css">
</head>

<body>
    <?php
        //including header
        require_once "components/header.php";
    ?>
    <div class="container text-center">
        <div class="container d-lg-flex p-2">
            <div class="container border border-2 rounded-3 p-2">
                <div class="container">
                    <a href="manage.php">
                        <img class="pict" src="statics/img/English teacher-rafiki.png">
                    </a>
                </div>
                <div class="container">
                    <span>
                        مدیریت دوره ها
                    </span>
                </div>
            </div>
            <div class="space"></div>
            <div class="container border border-2 rounded-3 p-2">
                <div class="container">
                    <div class="container">
                        <a href="setting.php">
                            <img class="pict" src="statics/img/In progress-cuate.png" alt="">
                        </a>
                    </div>
                    <div class="container">
                        <span>
                            تنظیمات
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container d-lg-flex p-2">
            <div class="container border border-2 rounded-3 p-2">
                <div class="container">
                    <div class="container">
                        <a href="bot_notify.php">
                            <img class="pict" src="statics/img/Push notifications-rafiki (1).png" alt="">
                        </a>
                    </div>
                    <div class="container">
                        <span>
                            اطلاع رسانی
                        </span>
                    </div>
                </div>
            </div>
            <div class="space"></div>
            <div class="container border border-2 rounded-3 p-2">
                <div class="container">
                    <div class="container">
                        <a href="#">
                            <img class="pict" src="statics/img/Make it rain-pana.png" alt="">
                        </a>
                    </div>
                    <div class="container">
                        <span>
                            امور مالی
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        //including footer
        require_once "components/footer.php";
    ?>
    <script src="statics/js/bootstrap.bundle.min.js"></script>
</body>

</html>