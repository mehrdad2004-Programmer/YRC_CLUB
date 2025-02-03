<?php
    require_once "database/database.php";
    require_once "course/Course.php";
    require_once "registration/registration.php";
    require_once "accounting/accounting.php";

    //$db = new \Modules\databas    e\Database();
    $course = new Course();
    $reg = new Registration();
    $acc = new Accounting();


//    $course->create_course([
//        "title" => "python",
//        "poster" => "poster.jpg",
//        "description" => "description about course",
//        "start" => "1403/12/12",
//        "date" => "1403",
//        "duration" => "12:00",
//        "code" => $course->unique_code()
//    ]);

//    $course->modify_course([
//        "title" => "python_beginner"
//    ], [
//        "code" => "356392"
//    ]);

    //$course->delete_course("18013");

//$reg->register_student([
//    "st_fname" => "mehrdad",
//    "st_lname" => "kalateh",
//    "st_id_no" => "0372647170",
//    "st_code" => "40215441054322",
//    "date" => "1403/05/12",
//    "time" => "12",
//    "course_code" => "1254545",
//    "university" => "azad",
//    "field" => "computer",
//    "phone" => "09190505223",
//
//]);

    $acc->set_bill([
        "id_no" => "0372647170",
        "amount" => "200000",
        "course_code" => "2020",
        "transaction_id" => "5745666",
        "date" => "1400",
        "time" => 12
    ]);