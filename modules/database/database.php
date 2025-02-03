<?php
    /*
    PHP QUERY BUILDER   
    */
    class Database{
        private $conn;
        public function __construct(){
            try{
                $info = json_decode(file_get_contents(__DIR__ . "/env.json"), true);

                $host = $info['host'];
                $username = $info['username'];
                $password = $info['password'];
                $dbname = $info['dbname'];
    
                $this->conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

                //echo "connected to database ....";
            }catch(Exception $e){
                echo $e;
            }
        }

        public function create(string $tablename, array $data){
            try{
                $query = "INSERT INTO " . $tablename ." ";
                $col = "";
                $val = "";
                foreach(array_keys($data) as $item){
                    $col .= $item . ",";
                    $val .= ":$item". ",";
                }
                $col = rtrim($col, ',');
                $val = rtrim($val, ",");
                //Buliding query
                $query .= "(" . $col . ")" . " VALUES " . "(" . $val . ")";
                
                $res = $this->conn->prepare($query);

                foreach(array_keys($data) as $item){
                    $res->bindParam(":$item", $data[$item]);
                }

                $res->execute();
                return true;
            }catch(Exception $e){
                echo $e;
                return false;
            }
        }

        public function read(string $tablename, array $conditions = []){
            try{
                $query = "";
                if(count($conditions) > 0){
                    $query = "SELECT * FROM $tablename WHERE ";
                    $con = "";
                    foreach(array_keys($conditions) as $item){
                        $con .= $item . " = " . "'" . $conditions[$item] . "'" . " AND ";
                    }
                    $con = rtrim($con, " AND ");
                    $query .= $con;
                }else{
                    $query = "SELECT * FROM $tablename";
                }
                //echo $query;
                $res = $this->conn->prepare($query);
                $res->execute();
                return $res->fetchAll();
            }catch(Exception $e){
                echo $e;
            }
        }

        public function update(string $tablename, array $newVal, array $oldVal){
            try{
                $query = "UPDATE $tablename SET ";
                $val = "";
                $con = "";
                foreach(array_keys($newVal) as $item){
                    $val .= $item . "=" . "'" . $newVal[$item] . "'" . ",";
                }

                foreach(array_keys($oldVal) as $item){
                    $con .= $item . "=" . "'" . $oldVal[$item] . "'" . " AND ";
                }
                $val = rtrim($val, ',');
                $con = rtrim($con, ' AND ');
                
                $query .= $val . " WHERE " . $con;
                
                $res = $this->conn->prepare($query);
                $res->execute();
                return true;
            }catch(Exception $e){
                echo $e;
                return false;
            }
        }

        public function delete(string $tablename, array $condition){
            try{
                $qeury = "DELETE FROM $tablename WHERE ";
                $con = "";
                foreach(array_keys($condition) as $item){
                    $con .= $item . " = " . "'" . $condition[$item] . "'" . " AND ";
                }
                $con = rtrim($con, " AND ");
                $qeury .= $con;
                //echo $qeury;
                $res = $this->conn->prepare($qeury);
                $res->execute();
                return true;
            }catch(Exception $e){
                echo $e;
                return false;
            }
        }

        public function join(array $tables, $type, $col, array $conditions=[]) : array{
            try{
                $counter = 0;
                $query = "SELECT DISTINCT * FROM $tables[0] $type JOIN ";
                foreach($tables as $table){
                    $counter++;
                    if($counter == 1){
                        continue;
                    } 
                    $query.= "$table on $tables[0].$col = $table.$col";
                }

                if(count($conditions) > 0){
                    $query .= " WHERE ";
                    foreach(array_keys($conditions) as $item){
                        $query.= $item . " = " . "'" . $conditions[$item] . "'";
                    }
                }
                //echo $query;
                $res = $this->conn->prepare($query);
                $res->execute();
                return array(
                    "result" => $res->fetchAll(PDO::FETCH_ASSOC)
                );
            }catch(Exception $e){
                return array(
                    "error" => $e
                );
            }
        }
    }

    //INSERT INTO info (fname,lname) VALUES (:fname,:lname)

    //$db = new Database("env.json");

    // $op = $db->create('students', [
    //     "fname" => "ali",
    //     "lname" => "sohrabi",
    //     "faname" => "hamid",
    //     "id_no" => "0372647170",
    //     "tracking_code" => rand(10000, 9999999),
    // ]);




    // if($op){
    //     echo "inserted successfully";
    // }else{
    //     echo "could not insert into table";
    // }

    //$op = $db->read("students", ["id_no='sdfasdfasfd'"]);


    // $op = $db->update('students', [
    //     "fname" => "mehrdad",
    //     "lname" => "kalateh",
    // ],
    // [
    //     "id_no" => "0372647170"
    // ]);

    // if($op){
    //     echo "updated successfully";
    // }else{
    //     echo "could not update table";
    // }

    // $db->delete('students', ["id_no = '0372647170'"]);

    // $db = new Database();
    // $data = $db->join(['users', 'payment'], "INNER", "st_id_no", ['users.st_id_no' => "0372647170"]);
    // print_r($data);