<?php
/*
PHP QUERY BUILDER
*/
class Database {
    private $conn;

    public function __construct() {
        try {
            $info = json_decode(file_get_contents(__DIR__ . "/env.json"), true);

            $host = $info['host'];
            $username = $info['username'];
            $password = $info['password'];
            $dbname = $info['dbname'];

            $this->conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function create(string $tablename, array $data) {
        try {
            $columns = implode(", ", array_keys($data));
            $placeholders = ":" . implode(", :", array_keys($data));

            // Building query
            $query = "INSERT INTO $tablename ($columns) VALUES ($placeholders)";
            $stmt = $this->conn->prepare($query);

            // Binding parameters
            foreach ($data as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }

            $stmt->execute();
            return true;
        } catch (Exception $e) {
            echo $e;
            return false;
        }
    }

    public function read(string $tablename, array $conditions = []) {
        try {
            $query = "SELECT * FROM $tablename";
            $params = [];

            if (count($conditions) > 0) {
                $query .= " WHERE ";
                $con = [];
                foreach ($conditions as $key => $value) {
                    $con[] = "$key = :$key";
                    $params[":$key"] = $value;
                }
                $query .= implode(" AND ", $con);
            }

            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function update(string $tablename, array $newVal, array $oldVal) {
        try {
            $set = [];
            $params = [];

            foreach ($newVal as $key => $value) {
                $set[] = "$key = :new_$key";
                $params[":new_$key"] = $value;
            }

            $query = "UPDATE $tablename SET " . implode(", ", $set) . " WHERE ";
            $con = [];
            foreach ($oldVal as $key => $value) {
                $con[] = "$key = :old_$key";
                $params[":old_$key"] = $value;
            }
            $query .= implode(" AND ", $con);

            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            return true;
        } catch (Exception $e) {
            echo $e;
            return false;
        }
    }

    public function delete(string $tablename, array $condition) {
        try {
            $query = "DELETE FROM $tablename WHERE ";
            $con = [];
            $params = [];

            foreach ($condition as $key => $value) {
                $con[] = "$key = :$key";
                $params[":$key"] = $value;
            }
            $query .= implode(" AND ", $con);

            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            return true;
        } catch (Exception $e) {
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
