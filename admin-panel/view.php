<?php 
    //adding authorization
    require_once __DIR__ . "/middleware/authorization.php";

?>
<?php
    require_once __DIR__ . "/../modules/course/Course.php";

    $course = new Course();
    if(isset($_GET['submit'])){
       $courses =  $course->fetch_courses($_GET['comm'], $_GET['year']);

    }

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
    <div class="container text-center mt-3 p-2">
        <h2>
            مشاهده دوره ها
        </h2>
    </div>
    <div class="container">
        <?php 
            if(isset($_SESSION['status'])){
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                        ".$_SESSION['status']."
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
            }
            unset($_SESSION['status']);
        ?>
    </div>
    <div class="container text-center mt-3">
        <form method="GET">
            <div class="container d-lg-flex">
                <div class="container">
                    <select class="form-control" name="comm" id="">
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
                    <select class="form-control" name="year" id="">
                        <?php
                            $year = 1403;
                            for($i = 0; $i < 5; $i++){
                                echo "<option>$year</option>";
                                $year++;
                            }
                        ?>
                        ?>
                    </select>
                </div>
                <div class="space"></div>
                <div>
                    <input class="btn btn-primary" type="submit" name="submit" value="تایید">
                </div>
            </div>
        </form>
        <div class="container mt-5">
            <h3>
                دوره های انجمن <?php echo $_GET['comm']?> - <?php echo     $_GET['year']?>
            </h3>
        </div>
        <table class="table mt-3 text-center">
            <thead>
              <tr>
                <th>#</th>
                <th>عنوان دوره</th>
                <th>تاریخ شروع</th>
                <th>مدرس</th>
                <th>وضعیت</th>
                <th>عملیات</th>
              </tr>
            </thead>
            <tbody>
                <?php
                    $counter = 0;
                    foreach($courses[0] as $item){
                        if($item['status'] == "0"){
                            $item['status'] = "غیر فعال";
                        }else{
                            $item['status'] = "فعال";
                        }
                        $counter++;
                        echo "
                            <tr>
                                <td>$counter</td>
                                <td>".$item['title']."</td>
                                <td>".$item['start']."</td>
                                <td>".$item['teacher']."</td>
                                <td>".$item['status']."</td>
                                <td>
                                    <a href='addCourse.php?mode=edit&code=".$item['code'] . "' class='btn btn-primary'>ویرایش دوره</a>
                                    <a class='btn btn-danger delete' code = '".$item['code']."'>حذف دوره</a>
                                    <a class='btn btn-warning status' code = '".$item['code']."'>فعال / غیرفعال</a>
                                    <a href='exp/exp.php?code=".$item['code']."' class='btn btn-success status' code = '".$item['code']." '>اکسل مالی</a>
                                </td>
                            </tr>
                        ";
                    }

                ?>
            </tbody>
          </table>
    </div>
    <?php
        //including footer
        require_once "components/footer.php";
    ?>
    <script src="statics/js/bootstrap.bundle.min.js"></script>

    <script>
        const status = document.querySelectorAll('.status');
        const del = document.querySelectorAll('.delete');

        status.forEach(item=>{
            //console.log(item);
            item.addEventListener('click', (e)=>{
                if(confirm("آیا اطمینان دارید؟")){
                    window.location.href = "opration.php?mode=status&code=" + e.target.getAttribute('code');
                }
            })
        })

        del.forEach(item => {
            item.addEventListener('click', (e)=>{
                if(confirm("آیا اطمینان دارید ؟")){
                    window.location.href = "opration.php?mode=delete&code=" + e.target.getAttribute('code');
                }
            })
        })

    </script>
</body>
</html>