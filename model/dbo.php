<?php

class Database {
    static public function getConnection() {
        try {
            // Formato correcto de conexión PDO para PostgreSQL
            $conn = new PDO(
                "pgsql:host=db.ohogktxghvemptcfofvx.supabase.co;port=5432;dbname=postgres",
                "postgres",
                "vdn9U9OFJ5ok4GSW",
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
            return $conn;
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
            return null;
        }
    }
}
