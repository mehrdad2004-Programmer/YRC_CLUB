<?php
//adding authorization
require_once __DIR__ . "/middleware/authorization.php";
require_once __DIR__ . "/middleware/sanitize.php";

?>
<?php

    $db = new Database();
    $user = new User();


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
<body dir="rtl">
<?php
//including header
require_once "components/header.php";
?>
    <div class="container text-center mt-5 p-2">
        <h2>
            تغییر توکن ربات بله
        </h2>
    </div>
    <div class="container">
        <?php
        if(isset($_POST['submit'])){
            $updated = $db->update('bot_token', ['token' => $_POST['token']], ["title" => "main"]);
            if($updated){
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                        توکن با موفقیت تغییر کرد
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
            }else{
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        خطا در بروزرسانی توکن، مجدد تلاش کنید
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
            }
        }
        ?>
    </div>
    <form action="" method="post">
        <div class="container">
            <div class="container">
                <div class="container mt-3">
                    <span>
                        توکن بات :
                    </span>
                </div>
                <div class="container p-2">
                    <input class="form-control" type="password" name="token">
                </div>
            </div>
            <div class="container text-center mt-3">
                <input class="btn btn-primary" type="submit" name="submit" value="تایید">
            </div>
        </div>
    </form>
<?php
//including footer
require_once "components/footer.php";
?>
    <script src="statics/js/bootstrap.bundle.min.js"></script>
</body>
</html>