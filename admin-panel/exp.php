<?php
//adding authorization
require_once __DIR__ . "/middleware/authorization.php";
require_once __DIR__ . "/middleware/sanitize.php";

?>
<?php
    require_once __DIR__ . "/../modules/database/database.php";
    $db = new Database();

    $db->join(['payment', 'registration'], "INNER", "st_id_no", [
        "courses.comunity" => $_GET['community'],
        "course.title" => $_GET['title']
    ])
    
    //print_r($data);
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
<?php
    if(isset($_SESSION['status'])){
        echo "<div class='alert container mt-3 alert-success alert-dismissible fade show' role='alert'>
                        ".$_SESSION['status']."
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";

        unset($_SESSION['status']);
    }
?>
    <div class="container text-center mt-3 p-2 p-none">
        <h2>
            صدور لیست کلاسی
        </h2>
    </div>


    <div class="container text-center">
        <form action="" method="GET" class="p-none">
            <div class="container d-lg-flex">
                <div class="container">
                    <select class="form-control" name="community" id="community">
                        <?php
                        $data = $db->read('communities');
                        foreach($data as $item){
                            echo "<option>".$item['title']."</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="space"></div>
                <div class="container">
                    <select class="form-control" name="" id="year">
                        <?php
                        $year = 1403;
                        for($i = 0; $i < 5; $i++){
                            echo "<option>$year</option>";
                            $year++;
                        }
                        ?>
                    </select>
                </div>
                <div class="space"></div>
                <div class="container">
                    <select class="form-control" name="title" id="courses">
                        
                    </select>
                </div>
                <div class="space"></div>
                <div>
                    <input class="btn btn-primary" type="button" name="submit" id="submit" value="تایید">
                </div>
            </div>
        </form>
        <div class="container text-center mt-3 p-none">
            <button onclick="window.print()" class="btn btn-danger">چاپ لیست</button>
        </div>

        <div class="mt-3">
            <h3 id="list-title"></h3>
        </div>
        <table class="table mt-5">
            <thead>
              <tr>
                <th>#</th>
                <th>نام و نام خانوادگی</th>
                <th>شماره دانشجویی</th>
                <th>رشته</th>
                <th>وضعیت</th>
              </tr>
            </thead>
            <tbody id="root">

            </tbody>
          </table>
    </div>
<?php
//including footer
require_once "components/footer.php";
?>
    <script src="statics/js/bootstrap.bundle.min.js"></script>
    <script src="statics/js/courseAjaxExp.js"></script>
</body>
</html>