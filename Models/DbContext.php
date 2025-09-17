<?php
namespace Models;

use mysqli;

class DbContext {
    private $host = "localhost";
    private $dbname = "sdc310l";
    private $username = "root";
    private $password = "";
    private $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);
            if ($this->conn->connect_error) {
                die("DB Conn Failed: " . $this->conn->connect_error);
            }
        } catch (\Exception $e) {
            echo "Conn Error: " . $e->getMessage();
        }
        return $this->conn;
    }
}

?>