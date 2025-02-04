<?php
    require_once __DIR__ . "/../database/database.php";

    class Course extends Database {
        private $table = "courses";
        public function __construct()
        {
            parent::__construct();
        }

        public function create_course(array $arr){
            try{
                $data = $this->create($this->table, $arr);
                if($data){
                    return true;
                }
                return false;
            }catch(Exception $e){
                echo $e;
                return false;
            }
        }

        public function modify_course(array $newVal, array $conditions){
            try{
                $updated = $this->update($this->table, $newVal, $conditions);
                if($updated){
                    return true;
                }
                return false;
            }catch(Exception $e){
                echo $e;
                return false;
            }
        }

        public function delete_course(string $code){
            try{
                $deleted = $this->delete($this->table, ['code' => $code]);
                if($deleted){
                    return true;
                }
                return false;
            }catch(Exception $e){
                echo $e;
                return false;
            }
        }

        public function fetch_courses($community, $year){
            $arr = [];
            $courses = $this->read('courses', ['comunity' => $community]);
            //print_r($courses);
            try{
                if($community == "" && $year == ""){
                    return "لطفا یکی از دوره ها را انتخاب نمایید";
                }
                foreach($courses as $item){
                    if(explode('/', $item['date'])[0] == $year){
                        array_push($arr, $courses);
                    }
                }
                return $arr;
            }catch(Exception $e){
                echo $e;
            }
        }

        public function unique_code(){
            $data = $this->read($this->table);
            //print_r($data);
            if(count($data) > 0){
                do{
                    $code = rand(100000, 9999999);
                }while(in_array($code, $data));
                return $code;
            }
            return rand(10000, 99999);
        }

        public function get_licenses($id_no = ""){
            try{
                if($id_no == ""){
                    return $this->read('course');
                }
                return $this->read('course', ['id_no' => $id_no]);
            }catch (Exception $e){
                return $e;
            }
        }
    }


