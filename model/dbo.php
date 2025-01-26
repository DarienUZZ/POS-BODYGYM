<?php

class database
{
    static public function getConnection()
    {

        try {
            $conn = new PDO("mysql:host=localhost;dbname=POS", "root", "");
            return $conn;
        } catch (Exception $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}
