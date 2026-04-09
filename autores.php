<?php
include_once 'config/db.php';

$database = new Database();
$db = $database->getConnection();

// Consulta a la tabla autores 
$query = "SELECT nombre, apellido, telefono, ciudad, pais FROM autores";
$stmt = $db->prepare($query);
$stmt->execute();
$autores = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuestros Autores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="index.php">Mi Librería</a>
            <div class="navbar-nav">
                <a class="nav-link" href="index.php">Libros</a>
                <a class="nav-link active" href="autores.php">Autores</a>
                <a class="nav-link" href="contacto.php">Contacto</a>
            </div>
        </div>
    </nav>

    <div class="container">
        [cite_start]<h2 class="mb-4 text-center">Listado de Autores</h2>
        <div class="row">
            <?php foreach($autores as $autor): ?>
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title text-primary"><?php echo $autor['nombre'] . " " . $autor['apellido']; ?></h5>
                        <p class="card-text">
                            <strong>País:</strong> <?php echo $autor['pais']; ?><br>
                            <strong>Ciudad:</strong> <?php echo $autor['ciudad']; ?><br>
                            <strong>Tel:</strong> <?php echo $autor['telefono']; ?>
                        </p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>