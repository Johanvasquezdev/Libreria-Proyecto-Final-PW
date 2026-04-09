<?php
// Clase para gestionar los libros en la base de datos
class Libro {
    private $conn;
    private $table_name = "titulos";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para obtener todos los libros
    public function getAll() {
        //  Uso de PDO
        $query = "SELECT id_titulo, titulo, tipo, precio, notas FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
?>