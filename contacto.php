<?php
include_once 'config/db.php';
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") { [cite: 36]
    $database = new Database();
    $db = $database->getConnection();

    // Campos: id, fecha, correo, nombre, asunto, comentario 
    $query = "INSERT INTO contacto (nombre, correo, asunto, comentario) VALUES (:nombre, :correo, :asunto, :comentario)";
    $stmt = $db->prepare($query);

    $stmt->execute([
        ':nombre' => $_POST['nombre'],
        ':correo' => $_POST['correo'],
        ':asunto' => $_POST['asunto'],
        ':comentario' => $_POST['comentario']
    ]);
    $mensaje = "¡Mensaje enviado con éxito!";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="max-w-md mx-auto mt-12 bg-white p-8 rounded-xl shadow-2xl">
        [cite_start]<h2 class="text-2xl font-bold mb-6 text-blue-900">Formulario de Contacto</h2> [cite: 19]
        
        <?php if($mensaje): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>

        [cite_start]<form method="POST" action="contacto.php" class="space-y-4"> [cite: 20, 36]
            <div>
                <label class="block text-sm font-medium text-gray-700">Nombre</label>
                <input type="text" name="nombre" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-2 bg-gray-50" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Correo</label>
                <input type="email" name="correo" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-2 bg-gray-50" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Asunto</label>
                <input type="text" name="asunto" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-2 bg-gray-50" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Comentario</label>
                <textarea name="comentario" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-2 bg-gray-50" required></textarea>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition duration-300">
                Guardar Información 
            </button>
        </form>
    </div>
</body>
</html>