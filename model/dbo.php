<?php
class Database
{
    static public function getConnection()
    {
        try {
            $host = 'aws-0-us-west-1.pooler.supabase.com';
            $port = '6543';
            $dbname = 'postgres';
            $user = 'postgres.ohogktxghvemptcfofvx';
            $password = 'T6hKEkw59ekcBs2q'; // reemplazar si cambiaste la contraseña

            $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
            $conn = new PDO($dsn, $user, $password);

            // Opcional: establecer modo de errores
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $conn;
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
            return null;
        }
    }
}
