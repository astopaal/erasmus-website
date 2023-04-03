<?php

class DBController
{
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $database = "erasmus";
    private $conn;

    function __construct()
    {
        $this->conn = $this->connectDB();
    }
    function connectDB()
    {
        $conn = mysqli_connect($this->host, $this->user, $this->password, $this->database);
        if($conn) {echo "db bağlantısı başarılı";} else {echo "db bağlantı hatası";}
        return $conn;
    }
    function runQuery($query)
    {
        $result = mysqli_query($this->conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $resultset[] = $row;
        }
        if (!empty($resultset)) {
            return $resultset;
        }
    }
    function numRows($query)
    {
        $result = mysqli_query($this->conn, $query);
        $rowcount = mysqli_num_rows($result);
        return $rowcount;
    }
    function insertQuery($query)
    {
        $result = mysqli_query($this->conn, $query);
        if ($result) {
            return mysqli_insert_id($this->conn);
        }
    }
    function updateQuery($query)
    {
        $result = mysqli_query($this->conn, $query);
        if ($result) {
            return mysqli_affected_rows($this->conn);
        }
    }
    function deleteQuery($query)
    {
        $result = mysqli_query($this->conn, $query);
        if ($result) {
            return mysqli_affected_rows($this->conn);
        }
    }

}

?>