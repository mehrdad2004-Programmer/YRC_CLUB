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
    <div class="container text-center p-2">
        <h2>
            تنظیمات
        </h2>
    </div>
    <div class="container text-center">
        <div class="container d-lg-flex p-2">
            <div class="container border border-2 rounded-3 p-2">
                <div class="container">
                    <a href="changePass.php">
                        <img class="pict" src="statics/img/My password-bro (1).png">
                    </a>
                </div>
                <div class="container">
                    <span>
                        تغییر رمز عبور
                    </span>
                </div>
            </div>
            <div class="space"></div>
            <div class="container border border-2 rounded-3 p-2">
                <div class="container">
                    <div class="container">
                        <a href="">
                            <img class="pict" src="statics/img/Tablet login-bro.png" alt="" style="filter: grayscale(0.8)">
                        </a>
                    </div>
                    <div class="container">
                        <span class="text-muted">
                            تغییر نام کاربری (غیرفعال)
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container d-lg-flex p-2">
            <div class="container border border-2 rounded-3 p-2">
                <div class="container">
                    <div class="container">
                        <a href="changeToken.php">
                            <img class="pict" src="statics/img/Data analysis-amico.png" alt="">
                        </a>
                    </div>
                    <div class="container">
                        <span>
                            تغییر توکن بات 
                        </span>
                    </div>
                </div>
            </div>
            <div class="space"></div>
            <div class="container border border-2 rounded-3 p-2">
                <div class="container">
                    <div class="container">
                        <a href="">
                            <img class="pict" src="statics/img/Add User-pana.png" alt="" style="filter: grayscale(0.8)">
                        </a>
                    </div>
                    <div class="container">
                        <span class="text-muted">
                            افزودن کاربر جدید (غیرفعال)
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