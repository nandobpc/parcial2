<?php
class Evento {
    // Conexión a la base de datos y nombre de la tabla
    private $conn;
    private $table_name = "eventos";

    // Propiedades del objeto Evento
    public $evento_id;
    public $nombre;
    public $fecha;
    public $ubicacion;
    public $descripcion;

    // Constructor para la conexión de la base de datos
    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para crear un evento
    public function create() {
        // Consulta de inserción
        $query = "INSERT INTO " . $this->table_name . " SET nombre=:nombre, fecha=:fecha, ubicacion=:ubicacion, descripcion=:descripcion";

        // Preparar la consulta
        $stmt = $this->conn->prepare($query);

        // Limpiar los datos
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->fecha = htmlspecialchars(strip_tags($this->fecha));
        $this->ubicacion = htmlspecialchars(strip_tags($this->ubicacion));
        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));

        // Enlazar los valores
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":fecha", $this->fecha);
        $stmt->bindParam(":ubicacion", $this->ubicacion);
        $stmt->bindParam(":descripcion", $this->descripcion);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Método para leer todos los eventos
    public function read() {
        // Consulta de selección
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY fecha ASC";

        // Preparar la consulta
        $stmt = $this->conn->prepare($query);

        // Ejecutar la consulta
        $stmt->execute();

        return $stmt;
    }

    // Método para actualizar un evento
    public function update() {
        // Consulta de actualización
        $query = "UPDATE " . $this->table_name . " SET nombre = :nombre, fecha = :fecha, ubicacion = :ubicacion, descripcion = :descripcion WHERE evento_id = :evento_id";

        // Preparar la consulta
        $stmt = $this->conn->prepare($query);

        // Limpiar los datos
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->fecha = htmlspecialchars(strip_tags($this->fecha));
        $this->ubicacion = htmlspecialchars(strip_tags($this->ubicacion));
        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
        $this->evento_id = htmlspecialchars(strip_tags($this->evento_id));

        // Enlazar los valores
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":fecha", $this->fecha);
        $stmt->bindParam(":ubicacion", $this->ubicacion);
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":evento_id", $this->evento_id);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Método para eliminar un evento
    public function delete() {
        // Consulta de eliminación
        $query = "DELETE FROM " . $this->table_name . " WHERE evento_id = :evento_id";

        // Preparar la consulta
        $stmt = $this->conn->prepare($query);

        // Limpiar los datos
        $this->evento_id = htmlspecialchars(strip_tags($this->evento_id));

        // Enlazar el id del evento
        $stmt->bindParam(":evento_id", $this->evento_id);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
