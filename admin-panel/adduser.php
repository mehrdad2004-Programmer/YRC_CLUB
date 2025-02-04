<?php
//adding authorization
require_once __DIR__ . "/middleware/authorization.php";
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>افزودن کاربر</title>
    <link rel="stylesheet" href="statics/css/bootstrap.min.css">
    <link rel="stylesheet" href="statics/css/style.css">
</head>
<body dir="rtl">
    <?php
        //including header
        require_once "components/header.php";
    ?>
    <?php
    if(isset($_POST['submit'])){
        $user = new User();

        $res = $user->createUser($_POST['username'], $_POST['username'], $_POST['fname'], $_POST['lname'], $_POST['semat']);

        if($res){
            echo "<div class='container mt-3 alert alert-success alert-dismissible fade show' role='alert'>
        کاربر با موفقیت به وجود آمد
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
        }else{
            echo "<div class='container mt-3 alert alert-danger alert-dismissible fade show' role='alert'>
        خطا در ثبت نام کاربر جدید ، مجدد تلاش کنید
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
        }
    }

    ?>
    <div class="container">
        <form method="POST">
            <div class="container mt-3">
                <div class="container">
                    <span>نام : </span>
                </div>
                <div class="container mt-3">
                    <input type="text" name="fname" class="form-control">
                </div>
            </div>

            <div class="container mt-3">
                <div class="container">
                    <span>نام خانوادگی : </span>
                </div>
                <div class="container mt-3">
                    <input type="text" name="lname" class="form-control">
                </div>
            </div>

            <div class="container mt-3">
                <div class="container">
                    <span>سمت شغلی : </span>
                </div>
                <div class="container mt-3">
                    <input type="text" name="semat" class="form-control">
                </div>
            </div>

            <div class="container mt-3">
                <div class="container">
                    <span>نام کاربری(کدملی) : </span>
                </div>
                <div class="container mt-3">
                    <input type="text" name="username" class="form-control">
                </div>
            </div>

            <div class="container mt-3">
                <input class="btn btn-primary" type="submit" name="submit" value="تایید">
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