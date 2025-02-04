<?php
    session_start();
    unset($_SESSION['token']);

    require_once __DIR__ . "/middleware/sanitize.php";

    require_once __DIR__ . "/../modules/users/authentication.php";
    require_once __DIR__ . "/../modules/users/user.php";
    require_once __DIR__ . "/../modules/database/database.php";

    if(isset($_POST['submit'])){
        $auth = new Authentication(new User(), new Database());
        $login = $auth->login($_POST['username'], $_POST['password']);
        if($login['result']){
            $_SESSION['token'] = $login['token'];
            echo "<div class='container mt-3 alert alert-success alert-dismissible fade show' role='alert'>
        با موفقیت احراز شد درحال انتقال...
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
            header("Location: index.php");
        }else{
            echo "<div class='container mt-3 alert alert-danger alert-dismissible fade show' role='alert'>
        عدم احراز، نام کاربری یا رمز عبور نادرست است
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
        }
    }
    

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ورود مدیر سامانه</title>
    <link rel="stylesheet" href="statics/css/bootstrap.min.css">
    <link rel="stylesheet" href="statics/css/style.css">
</head>
<body dir="rtl">
    <div class="border border-primary login-box rounded-3 border-2 p-2">
        <div class="container text-center">
            <img class="logo1" src="statics/img/logoAnjoman.png" alt="">
        </div>
        <div class="container text-center p-2">
            <h4>
                باشگاه پژوهشگران و نخبگان جوان
            </h4>
        </div>
        <form action="" method="POST">
            <div class="container">
                <div class="container">
                    <div class="container mt-3" style="width: 300px">
                    <span>
                        نام کاربری :
                    </span>
                    </div>
                    <div class="container p-2" style="width: 300px">
                        <input class="form-control" type="text" name="username" style="width: 300px">
                    </div>
                    <div class="container mt-3" style="width: 300px">
                    <span>
                        رمز عبور :
                    </span>
                    </div>
                    <div class="container p-2" style="width: 300px;">
                        <input class="form-control" type="password" name="password" style="width: 300px">
                    </div>
                </div>
                <div class="container text-center mt-3">
                    <input class="btn btn-primary" type="submit" value="ورود" name="submit">
                </div>
<!--                <div class="container text-center mt-3">-->
<!--                    <a href="#">-->
<!--                        فراموشی رمز عبور-->
<!--                    </a>-->
<!--                </div>-->
            </div>
        </form>
    </div>
    <script src="statics/js/bootstrap.bundle.min.js"></script>
</body>
</html>