<?php
namespace app\database\config;

use mysqli; //import this class which responsible for the cconnection between php & mysql
class connection
{
    private $hostName = "localhost", $userName = "root", $password = "", $database = "e-commerce";
    protected $conn;
    function __construct() //invoke connection from construct
    {
        $this->conn = new mysqli($this->hostName, $this->userName, $this->password, $this->database);
    }

    public function runDML($query): bool // return true if action happened or false vice versa
    {
        $result = $this->conn->query($query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    public function runDQL($query) //return array either filled with output data or empty
    {
        return $this->conn->query($query);
    }

    //close connection
    function __destruct()
    {
        $this->conn->close();
    }
}

// new connection();