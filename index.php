<?php
include_once 'config/db.php';
include_once 'models/Libro.php';
// Se establece la conexión a la base de datos
$database = new Database();
$db = $database->getConnection();

$libroModel = new Libro($db);
$stmt = $libroModel->getAll(); 
$libros = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
// Página para mostrar el listado de libros
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Librería ITLA - Libros</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
    <nav class="bg-blue-900 p-4 text-white shadow-lg">
        <div class="container mx-auto flex justify-between">
           <h1 class="font-bold text-xl text-yellow-400">ITLA Librería</h1> 
            <div class="space-x-4">
                <a href="index.php" class="hover:text-yellow-400 border-b-2 border-yellow-400">Libros</a>
                <a href="autores.php" class="hover:text-yellow-400">Autores</a>
                <a href="contacto.php" class="hover:text-yellow-400">Contacto</a>
            </div>
        </div>
    </nav>
// Requerimiento: Mostrar el título, tipo y precio de cada libro en una tabla
    <div class="container mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-3xl font-bold mb-6 text-gray-800 text-center">Listado de Libros</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-4 py-2">Título</th>
                        <th class="px-4 py-2">Tipo</th>
                        <th class="px-4 py-2">Precio</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    <?php foreach ($libros as $libro): ?>
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-3 font-semibold"><?php echo $libro['titulo']; ?></td>
                        <td class="px-4 py-3"><?php echo $libro['tipo']; ?></td>
                        <td class="px-4 py-3 text-green-600 font-bold">$<?php echo number_format($libro['precio'], 2); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>