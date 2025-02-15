<?php

class Database {
    static public function getConnection() {
        try {
            $host = "db-pos.chc4tcuu6szl.us-east-1.rds.amazonaws.com";
            $port = "3306";
            $dbname = "db_pos_system";
            $user = "supadmin";
            $pass = "sT^FE5Ns0ih7OQ+n";
            $conn = new PDO("mysql:host=$host;dbname=$dbname",$user,$pass,);
            return $conn;
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
            return null;
        }
    }
}