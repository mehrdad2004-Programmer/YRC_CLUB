<?php
    //sanitizing GET requests
    if(count($_GET) > 0){
        foreach(array_keys($_GET) as $item){
            $_GET[$item] = filter_var($_GET[$item], FILTER_SANITIZE_STRING);
            $_GET[$item] = filter_var($_GET[$item], FILTER_SANITIZE_URL);
        }
    }else if(count($_POST) > 0){
        foreach(array_keys($_POST) as $item){
            $_POST[$item] = filter_var($_POST[$item], FILTER_SANITIZE_STRING);
        }
    }