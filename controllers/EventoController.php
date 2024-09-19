<?php
// Incluir la configuración de la base de datos y el modelo de Evento
include_once '../config/db.php';
include_once '../models/Evento.php';

// Instanciar la base de datos y el objeto Evento
$database = new Database();
$db = $database->getConnection();
$evento = new Evento($db);

// Determinar el método HTTP para manejar la solicitud
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si la solicitud es para crear un nuevo evento
    if (isset($_POST['nombre'], $_POST['fecha'], $_POST['ubicacion'], $_POST['descripcion'])) {
        // Asignar los valores del formulario al objeto Evento
        $evento->nombre = $_POST['nombre'];
        $evento->fecha = $_POST['fecha'];
        $evento->ubicacion = $_POST['ubicacion'];
        $evento->descripcion = $_POST['descripcion'];

        // Intentar crear el evento
        if ($evento->create()) {
            // Responder con éxito si el evento se creó correctamente
            echo json_encode(["message" => "Evento creado correctamente."]);
        } else {
            // Responder con un error si hubo problemas al crear el evento
            echo json_encode(["message" => "No se pudo crear el evento."]);
        }
    } else {
        // Responder con un mensaje de error si faltan datos
        echo json_encode(["message" => "Faltan datos obligatorios."]);
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Si el método es GET, devolver todos los eventos
    $stmt = $evento->read();
    $eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Responder con los eventos en formato JSON
    echo json_encode($eventos);
} else {
    // Responder con un error si el método HTTP no es permitido
    echo json_encode(["message" => "Método no permitido."]);
}
?>
