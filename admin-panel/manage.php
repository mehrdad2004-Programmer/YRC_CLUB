<?php 
    //adding authorization
    require_once __DIR__ . "/middleware/authorization.php";
    require_once __DIR__ . "/middleware/sanitize.php";

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
    <?php
        //including header
        require_once "components/header.php";
    ?>
    <div class="container text-center p-2">
        <h2>
            مدیریت دوره ها
        </h2>
    </div>
    <div class="container text-center">
        <div class="container d-lg-flex p-2">
            <div class="container border border-2 rounded-3 p-2">
                <div class="container">
                    <a href="addCourse.php?mode=create">
                        <img class="pict" src="statics/img/Course app-bro.png">
                    </a>
                </div>
                <div class="container">
                    <span>
                        افزودن دوره
                    </span>
                </div>
            </div>
            <div class="space"></div>
            <div class="container border border-2 rounded-3 p-2">
                <div class="container">
                    <div class="container">
                        <a href="view.php?community=کامپیوتر&year=1403&submit=تایید">
                            <img class="pict" src="statics/img/Files sent-bro.png" alt="">
                        </a>
                    </div>
                    <div class="container">
                        <span>
                            مشاهده دوره ها
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container d-lg-flex p-2">
            <div class="container border border-2 rounded-3 p-2">
                <div class="container">
                    <div class="container">
                        <a href="#">
                            <img class="pict" src="statics/img/Certification-rafiki.png" alt="" style="filter: grayscale(0.8)">
                        </a>
                    </div>
                    <div class="container">
                        <span class="text-muted">
                            گواهی ها (غیرفعال)
                        </span>
                    </div>
                </div>
            </div>
            <div class="space"></div>
            <div class="container border border-2 rounded-3 p-2">
                <div class="container">
                    <div class="container">
                        <a href="exp.php">
                            <img class="pict" src="statics/img/Checklist-rafiki (1).png" alt="">
                        </a>
                    </div>
                    <div class="container">
                        <span>
                            صدور لیست کلاسی
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