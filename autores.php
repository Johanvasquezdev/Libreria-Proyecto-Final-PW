<?php
include_once 'config/db.php';
// Establecer conexión a la base de datos
$database = new Database();
$db = $database->getConnection();
// Obtener todos los autores usando PDO
$query = "SELECT nombre, apellido, telefono, ciudad, pais FROM autores";
$stmt = $db->prepare($query);
$stmt->execute();
$autores = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Autores - ITLA Librería</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { background-color: #0f172a; }
        .card-hover { transition: all 0.2s ease; }
        .card-hover:hover { transform: translateY(-4px); box-shadow: 0 0 25px rgba(99,102,241,0.35); }
    </style>
</head>
<body class="text-gray-100 font-sans min-h-screen">

    <!-- Navbar -->
    <nav class="bg-gray-900 border-b border-indigo-900 px-6 py-4 sticky top-0 z-50">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center text-white font-bold text-sm">L</div>
                <h1 class="font-bold text-xl text-white">ITLA <span class="text-indigo-400">Librería</span></h1>
            </div>
            <div class="flex gap-6">
                <a href="index.php" class="text-gray-400 hover:text-indigo-400 transition pb-1">Libros</a>
                <a href="autores.php" class="text-indigo-400 border-b-2 border-indigo-400 pb-1 font-medium">Autores</a>
                <a href="contacto.php" class="text-gray-400 hover:text-indigo-400 transition pb-1">Contacto</a>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <div class="bg-gradient-to-r from-gray-900 via-indigo-950 to-gray-900 py-12 px-6 text-center border-b border-indigo-900">
        <h2 class="text-4xl font-bold text-white mb-2">Nuestros <span class="text-indigo-400">Autores</span></h2>
        <p class="text-gray-400">Conoce a los escritores de nuestra colección</p>
    </div>

    <!-- Cards -->
    <div class="container mx-auto mt-10 px-6 pb-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach($autores as $autor): ?>
            <div class="card-hover bg-gray-900 border border-gray-700 rounded-2xl p-6">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 bg-indigo-700 rounded-full flex items-center justify-center text-white font-bold text-lg">
                        <?php echo strtoupper(substr(trim($autor['nombre']), 0, 1) . substr($autor['apellido'], 0, 1)); ?>
                    </div>
                    <div>
                        <h3 class="font-bold text-white text-lg leading-tight">
                            <?php echo htmlspecialchars(trim($autor['nombre']) . ' ' . $autor['apellido']); ?>
                        </h3>
                        <span class="text-indigo-400 text-xs"><?php echo htmlspecialchars($autor['pais']); ?></span>
                    </div>
                </div>
                <div class="border-t border-gray-700 pt-4 space-y-2">
                    <div class="flex items-center gap-2 text-sm text-gray-400">
                        <span class="text-indigo-500">📍</span>
                        <?php echo htmlspecialchars($autor['ciudad']); ?>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-400">
                        <span class="text-indigo-500">📞</span>
                        <?php echo htmlspecialchars($autor['telefono']); ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <p class="text-gray-600 text-sm mt-6 text-right">Total: <?php echo count($autores); ?> autores</p>
    </div>

</body>
</html>