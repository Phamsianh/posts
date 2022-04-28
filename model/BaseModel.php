<?php

include dirname(__FILE__) . '/../config.php';

class BaseModel {
    protected $conn;
    protected $tablename = "";

    function __construct()
    {
        $this->conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        // else {
        //     echo "Connected successfully";
        // }
    }

    function __destruct()
    {
        $this->conn->close();
    }

    public function get_from_id(int $id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->tablename . " WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();

        // $result = $this->conn->query($query);
        return $stmt->get_result()->fetch_assoc();
    }

    public function check_input(
        string $data
    ){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // public function post() {

    // }

    // public function put() {

    // }

    // public function delete() {

    // }

}

?>