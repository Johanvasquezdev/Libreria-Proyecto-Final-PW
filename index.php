<?php
include_once 'config/db.php';
include_once 'models/Libro.php';
// Establecer conexión a la base de datos
$database = new Database();
$db = $database->getConnection();

$libroModel = new Libro($db);
$stmt = $libroModel->getAll(); 
$libros = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Librería ITLA - Libros</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { background-color: #0f172a; }
        .glow { box-shadow: 0 0 15px rgba(99,102,241,0.3); }
        .card-hover:hover { transform: translateY(-2px); transition: all 0.2s ease; box-shadow: 0 0 20px rgba(99,102,241,0.4); }
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
                <a href="index.php" class="text-indigo-400 border-b-2 border-indigo-400 pb-1 font-medium">Libros</a>
                <a href="autores.php" class="text-gray-400 hover:text-indigo-400 transition pb-1">Autores</a>
                <a href="contacto.php" class="text-gray-400 hover:text-indigo-400 transition pb-1">Contacto</a>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <div class="bg-gradient-to-r from-gray-900 via-indigo-950 to-gray-900 py-12 px-6 text-center border-b border-indigo-900">
        <h2 class="text-4xl font-bold text-white mb-2">Listado de <span class="text-indigo-400">Libros</span></h2>
        <p class="text-gray-400">Explora nuestra colección disponible</p>
    </div>

    <!-- Tabla -->
    <div class="container mx-auto mt-10 px-6 pb-16">
        <div class="bg-gray-900 rounded-2xl border border-gray-700 overflow-hidden glow">
            <table class="min-w-full">
                <thead>
                    <tr class="bg-indigo-950 border-b border-indigo-800">
                        <th class="px-6 py-4 text-left text-indigo-300 font-semibold text-sm uppercase tracking-wider">#</th>
                        <th class="px-6 py-4 text-left text-indigo-300 font-semibold text-sm uppercase tracking-wider">Título</th>
                        <th class="px-6 py-4 text-left text-indigo-300 font-semibold text-sm uppercase tracking-wider">Tipo</th>
                        <th class="px-6 py-4 text-left text-indigo-300 font-semibold text-sm uppercase tracking-wider">Precio</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800">
                    <?php $i = 1; foreach ($libros as $libro): ?>
                    <tr class="card-hover hover:bg-gray-800 transition-all duration-200">
                        <td class="px-6 py-4 text-gray-500 text-sm"><?php echo $i++; ?></td>
                        <td class="px-6 py-4 font-semibold text-white"><?php echo htmlspecialchars($libro['titulo']); ?></td>
                        <td class="px-6 py-4">
                            <span class="bg-indigo-900 text-indigo-300 text-xs px-3 py-1 rounded-full">
                                <?php echo htmlspecialchars($libro['tipo']); ?>
                            </span>
                        </td>
                        <td class="px-6 py-4 text-green-400 font-bold">
                            <?php echo $libro['precio'] ? '$' . number_format($libro['precio'], 2) : '<span class="text-gray-500">N/D</span>'; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <p class="text-gray-600 text-sm mt-4 text-right">Total: <?php echo count($libros); ?> libros</p>
    </div>

</body>
</html>