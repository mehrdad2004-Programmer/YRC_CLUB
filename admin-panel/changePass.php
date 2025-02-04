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
            تغییر رمز عبور
        </h2>
    </div>
    <div class="container">
        <?php
        if(isset($_POST['submit'])){
            if($_POST['pass'] === $_POST['repass']){
                $username = $db->read('users', ['token' => $_SESSION['token']]);
                if(count($username) > 0){
                    $user->modifyUser($username[0]['username'], password_hash($_POST['pass'], PASSWORD_DEFAULT));
                    $_SESSION['change_pass'] = true;
                    header("Location: login.php");
                }
            }else{
                echo "<div class='alert container mt-3 alert-danger alert-dismissible fade show' role='alert'>
                        رمزعبور های وارد شده صحیح نمی باشد
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
            }
        }
        ?>
    </div>
    <div class="container mt-3">
        <u><b>در صورت صحت عملیات به صفحه ورود منتقل خواهید شد</b></u>
    </div>
    <form action="" method="post">
        <div class="container">
            <div class="container">
                <div class="container mt-3">
                    <span>
                        رمز عبور جدید :
                    </span>
                </div>
                <div class="container p-2">
                    <input class="form-control" type="password" name="pass">
                </div>
                <div class="container mt-3">
                    <span>
                        تکرار رمز عبور :
                    </span>
                </div>
                <div class="container p-2">
                    <input class="form-control" type="password" name="repass">
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