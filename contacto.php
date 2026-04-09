<?php
include_once 'config/db.php';
$mensaje = "";
// Requerimiento: Almacenar información del formulario de contacto usando PDO
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $database = new Database();
    $db = $database->getConnection();

    $query = "INSERT INTO contacto (nombre, correo, asunto, comentario) VALUES (:nombre, :correo, :asunto, :comentario)";
    $stmt = $db->prepare($query);

    $stmt->execute([
        ':nombre'     => htmlspecialchars(strip_tags($_POST['nombre'])),
        ':correo'     => htmlspecialchars(strip_tags($_POST['correo'])),
        ':asunto'     => htmlspecialchars(strip_tags($_POST['asunto'])),
        ':comentario' => htmlspecialchars(strip_tags($_POST['comentario']))
    ]);
    $mensaje = "¡Mensaje enviado con éxito!";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contacto - ITLA Librería</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { background-color: #0f172a; }
        input, textarea {
            background-color: #1e293b !important;
            border: 1px solid #374151;
            color: #f1f5f9 !important;
            border-radius: 0.5rem;
            padding: 0.6rem 0.9rem;
            width: 100%;
            outline: none;
            transition: border 0.2s;
        }
        input:focus, textarea:focus { border-color: #6366f1; }
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
                <a href="autores.php" class="text-gray-400 hover:text-indigo-400 transition pb-1">Autores</a>
                <a href="contacto.php" class="text-indigo-400 border-b-2 border-indigo-400 pb-1 font-medium">Contacto</a>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <div class="bg-gradient-to-r from-gray-900 via-indigo-950 to-gray-900 py-12 px-6 text-center border-b border-indigo-900">
        <h2 class="text-4xl font-bold text-white mb-2">Formulario de <span class="text-indigo-400">Contacto</span></h2>
        <p class="text-gray-400">Envíanos tu mensaje y te responderemos pronto</p>
    </div>

    <!-- Formulario -->
    <div class="container mx-auto mt-10 px-6 pb-16 max-w-xl">
        <div class="bg-gray-900 border border-gray-700 rounded-2xl p-8" style="box-shadow: 0 0 20px rgba(99,102,241,0.2);">

            <?php if($mensaje): ?>
                <div class="bg-green-900 border border-green-600 text-green-300 px-4 py-3 rounded-lg mb-6 text-center font-medium">
                    ✅ <?php echo $mensaje; ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="contacto.php" class="space-y-5">
                <div>
                    <label class="block text-sm font-medium text-indigo-300 mb-1">Nombre</label>
                    <input type="text" name="nombre" placeholder="Tu nombre completo" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-indigo-300 mb-1">Correo</label>
                    <input type="email" name="correo" placeholder="tucorreo@email.com" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-indigo-300 mb-1">Asunto</label>
                    <input type="text" name="asunto" placeholder="¿De qué trata tu mensaje?" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-indigo-300 mb-1">Comentario</label>
                    <textarea name="comentario" rows="4" placeholder="Escribe tu mensaje aquí..." required></textarea>
                </div>
                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-4 rounded-xl transition duration-300">
                    Enviar Mensaje
                </button>
            </form>
        </div>
    </div>

</body>
</html>