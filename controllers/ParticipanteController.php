<?php

include_once '../config/db.php';
include_once '../models/Participante.php';

// Instanciar la base de datos y el objeto Participante
$database = new Database();
$db = $database->getConnection();
$participante = new Participante($db);

// Determinar el método HTTP para manejar la solicitud
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si la solicitud es para crear un nuevo participante
    if (isset($_POST['nombre'], $_POST['apellido'], $_POST['email'], $_POST['telefono'])) {
        // Asignar los valores del formulario al objeto Participante
        $participante->nombre = $_POST['nombre'];
        $participante->apellido = $_POST['apellido'];
        $participante->email = $_POST['email'];
        $participante->telefono = $_POST['telefono'];

        // Intentar crear el participante
        if ($participante->create()) {
            // Responder con éxito si el participante se creó correctamente
            echo json_encode(["message" => "Participante creado correctamente."]);
        } else {
            // Responder con un error si hubo problemas al crear el participante
            echo json_encode(["message" => "No se pudo crear el participante."]);
        }
    } else {
        // Responder con un mensaje de error si faltan datos obligatorios
        echo json_encode(["message" => "Faltan datos obligatorios."]);
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Si el método es GET, devolver todos los participantes
    $stmt = $participante->read();
    $participantes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Responder con los participantes en formato JSON
    echo json_encode($participantes);
} else {
    // Responder con un error si el método HTTP no es permitido
    echo json_encode(["message" => "Método no permitido."]);
}
?>
