<?php

class Database {

    protected $conn;

    public function connect() {
        $this->conn = mysqli_connect("localhost", "root", "", "demo_mvc");

        // Check for connection errors
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

        return $this->conn;
    }



}

?>