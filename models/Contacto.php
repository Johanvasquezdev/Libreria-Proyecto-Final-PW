<?php
class Contacto {
    private $conn;
    private $table_name = "contacto";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Requerimiento: Almacenar información del formulario de contacto 
    public function registrar($nombre, $correo, $asunto, $comentario) {
        // Requerimiento: Uso de PDO y sentencias preparadas
        $query = "INSERT INTO " . $this->table_name . " 
                  (nombre, correo, asunto, comentario) 
                  VALUES (:nombre, :correo, :asunto, :comentario)";
        
        $stmt = $this->conn->prepare($query);

        // Limpieza de datos (Sanitize)
        $nombre = htmlspecialchars(strip_tags($nombre));
        $correo = htmlspecialchars(strip_tags($correo));
        $asunto = htmlspecialchars(strip_tags($asunto));
        $comentario = htmlspecialchars(strip_tags($comentario));

        // Vincular parámetros
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":correo", $correo);
        $stmt->bindParam(":asunto", $asunto);
        $stmt->bindParam(":comentario", $comentario);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>