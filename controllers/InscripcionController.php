<?php

include_once '../config/db.php';
include_once '../models/Inscripcion.php';

// Instanciar la base de datos y el objeto Inscripcion
$database = new Database();
$db = $database->getConnection();
$inscripcion = new Inscripcion($db);

// Determinar el método HTTP para manejar la solicitud
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si la solicitud es para crear una nueva inscripción
    if (isset($_POST['evento_id'], $_POST['participante_id'], $_POST['fecha_inscripcion'])) {
        // Asignar los valores del formulario al objeto Inscripcion
        $inscripcion->evento_id = $_POST['evento_id'];
        $inscripcion->participante_id = $_POST['participante_id'];
        $inscripcion->fecha_inscripcion = $_POST['fecha_inscripcion'];

        if ($inscripcion->create()) {
            // Responder con éxito si la inscripción se creó correctamente
            echo json_encode(["message" => "Inscripción creada correctamente."]);
        } else {
            // Responder con un error si hubo problemas al crear la inscripción
            echo json_encode(["message" => "No se pudo crear la inscripción."]);
        }
    } else {
        // Responder con un mensaje de error si faltan datos
        echo json_encode(["message" => "Faltan datos obligatorios."]);
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Si el método es GET, devolver todas las inscripciones
    $stmt = $inscripcion->read();
    $inscripciones = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Responder con las inscripciones en formato JSON
    echo json_encode($inscripciones);
} else {
    // Responder con un error si el método HTTP no es permitido
    echo json_encode(["message" => "Método no permitido."]);
}
?>
