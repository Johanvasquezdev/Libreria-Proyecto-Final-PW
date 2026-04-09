<?php
// Clase para gestionar la conexión a MySQL usando PDO
class Database {
    private $host = "localhost"; // Cambiar por los datos de tu hosting gratuito
    private $db_name = "dblibreria"; // Nombre de la base de datos importada 
    private $username = "root"; 
    private $password = ""; 
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            // Se establece la conexión con el driver de MySQL 
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            // Configurar para que las consultas manejen caracteres especiales 
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>