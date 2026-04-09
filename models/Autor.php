<?php
// Clase para gestionar los autores en la base de datos
class Autor {
    private $conn;
    private $table_name = "autores";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para obtener todos los autores
    public function getAll() {
        $query = "SELECT nombre, apellido, telefono, ciudad, pais FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
?>