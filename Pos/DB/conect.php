<?php

define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "pos_db");

class Conect
{
    public $db;
    public function __construct()
    {
        $conect = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if (!$conect) {
            die("Connection failed: " . mysqli_connect_error());
        }else{
            return $this->db = $conect;
        }
    }
}