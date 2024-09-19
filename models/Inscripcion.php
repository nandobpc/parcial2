<?php
class Inscripcion {
    // Conexión a la base de datos y nombre de la tabla
    private $conn;
    private $table_name = "inscripciones";

    // Propiedades del objeto Inscripción
    public $inscripcion_id;
    public $evento_id;
    public $participante_id;
    public $fecha_inscripcion;

    // Constructor para la conexión de la base de datos
    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para crear una nueva inscripción
    public function create() {
        // Consulta de inserción
        $query = "INSERT INTO " . $this->table_name . " SET evento_id=:evento_id, participante_id=:participante_id, fecha_inscripcion=:fecha_inscripcion";

        // Preparar la consulta
        $stmt = $this->conn->prepare($query);

        // Limpiar los datos
        $this->evento_id = htmlspecialchars(strip_tags($this->evento_id));
        $this->participante_id = htmlspecialchars(strip_tags($this->participante_id));
        $this->fecha_inscripcion = htmlspecialchars(strip_tags($this->fecha_inscripcion));

        // Enlazar los valores
        $stmt->bindParam(":evento_id", $this->evento_id);
        $stmt->bindParam(":participante_id", $this->participante_id);
        $stmt->bindParam(":fecha_inscripcion", $this->fecha_inscripcion);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Método para leer todas las inscripciones
    public function read() {
        // Consulta de selección
        $query = "SELECT i.inscripcion_id, e.nombre as evento, p.nombre as participante, i.fecha_inscripcion 
                  FROM " . $this->table_name . " i
                  JOIN eventos e ON i.evento_id = e.evento_id
                  JOIN participantes p ON i.participante_id = p.participante_id
                  ORDER BY i.fecha_inscripcion DESC";

        // Preparar la consulta
        $stmt = $this->conn->prepare($query);

        // Ejecutar la consulta
        $stmt->execute();

        return $stmt;
    }

    // Método para actualizar una inscripción
    public function update() {
        // Consulta de actualización
        $query = "UPDATE " . $this->table_name . " SET evento_id = :evento_id, participante_id = :participante_id, fecha_inscripcion = :fecha_inscripcion WHERE inscripcion_id = :inscripcion_id";

        // Preparar la consulta
        $stmt = $this->conn->prepare($query);

        // Limpiar los datos
        $this->evento_id = htmlspecialchars(strip_tags($this->evento_id));
        $this->participante_id = htmlspecialchars(strip_tags($this->participante_id));
        $this->fecha_inscripcion = htmlspecialchars(strip_tags($this->fecha_inscripcion));
        $this->inscripcion_id = htmlspecialchars(strip_tags($this->inscripcion_id));

        // Enlazar los valores
        $stmt->bindParam(":evento_id", $this->evento_id);
        $stmt->bindParam(":participante_id", $this->participante_id);
        $stmt->bindParam(":fecha_inscripcion", $this->fecha_inscripcion);
        $stmt->bindParam(":inscripcion_id", $this->inscripcion_id);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Método para eliminar una inscripción
    public function delete() {
        // Consulta de eliminación
        $query = "DELETE FROM " . $this->table_name . " WHERE inscripcion_id = :inscripcion_id";

        // Preparar la consulta
        $stmt = $this->conn->prepare($query);

        // Limpiar los datos
        $this->inscripcion_id = htmlspecialchars(strip_tags($this->inscripcion_id));

        // Enlazar el id de la inscripción
        $stmt->bindParam(":inscripcion_id", $this->inscripcion_id);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
