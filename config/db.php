<?php
// Clase para gestionar la conexión a MySQL usando PDO
class Database
{
    private $host = "sql111.infinityfree.com";
    private $db_name = "if0_41615515_dblibreria";
    private $username = "if0_41615515";
    private $password = "EHaxqq1p5nxm9u";
    public $conn;

    public function getConnection()
    {
        $this->conn = null;
        try {
            // Se establece la conexión con el driver de MySQL 
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            // Configurar para que las consultas manejen caracteres especiales 
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
