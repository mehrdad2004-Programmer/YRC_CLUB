<?php
    header("Content-Type: application/json");
    require_once __DIR__ . "/../../modules/database/database.php";
    $db = new Database();


    switch($_GET['mode']){
        case "community":
            $counter = 0;
            $data = $db->join(['registration', 'payment'], 'LEFT', "st_id_no");
            foreach($data['result'] as &$item){
                //print_r($item);
                $item['community'] = $db->read('courses', ['code' => $item['course_code']])[0]['comunity'];
                $item['course_title'] = $db->read('courses', ['code' => $item['course_code']])[0]['title'];
                $item['course_teacher'] = $db->read('courses', ['code' => $item['course_code']])[0]['teacher'];
                $item['course_date'] = $db->read('courses', ['code' => $item['course_code'] ])[0]['date'];
            }
            print_r(json_encode($data, JSON_PRETTY_PRINT));
            break;

    }
?>