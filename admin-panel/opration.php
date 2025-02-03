<?php
    session_start();
    require_once __DIR__ . "/../modules/database/database.php";

    $db = new Database();

    switch($_GET['mode']){
        case "status":
            $status = $db->read('courses', ['code' => $_GET['code']]);
            if($status[0]['status'] == "1"){
                $db->update('courses', ['status' => "0"], ['code' => $_GET['code']]);
                $_SESSION['status'] = "دوره غیرفعال شد";
            }else{
                $db->update('courses', ['status' => "1"], ['code' => $_GET['code']]);
                $_SESSION['status'] = "دوره فعال شد";
            }
            break;
        case "delete":
            $db->delete('courses', ['code' => $_GET['code']]);
            $_SESSION['status'] = "دوره با موفقیت حذف شد";
            break;
    }

    header("Location: view.php?community=کامپیوتر&year=1403&submit=تایید");