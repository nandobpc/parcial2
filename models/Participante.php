<?php
class Participante {
    // Conexión a la base de datos y nombre de la tabla
    private $conn;
    private $table_name = "participantes";

    // Propiedades del objeto Participante
    public $participante_id;
    public $nombre;
    public $apellido;
    public $email;
    public $telefono;

    // Constructor para la conexión de la base de datos
    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para crear un nuevo participante
    public function create() {
        // Consulta de inserción
        $query = "INSERT INTO " . $this->table_name . " SET nombre=:nombre, apellido=:apellido, email=:email, telefono=:telefono";

        // Preparar la consulta
        $stmt = $this->conn->prepare($query);

        // Limpiar los datos
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->apellido = htmlspecialchars(strip_tags($this->apellido));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->telefono = htmlspecialchars(strip_tags($this->telefono));

        // Enlazar los valores
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":apellido", $this->apellido);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":telefono", $this->telefono);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Método para leer todos los participantes
    public function read() {
        // Consulta de selección
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY apellido ASC";

        // Preparar la consulta
        $stmt = $this->conn->prepare($query);

        // Ejecutar la consulta
        $stmt->execute();

        return $stmt;
    }

    // Método para actualizar un participante
    public function update() {
        // Consulta de actualización
        $query = "UPDATE " . $this->table_name . " SET nombre = :nombre, apellido = :apellido, email = :email, telefono = :telefono WHERE participante_id = :participante_id";

        // Preparar la consulta
        $stmt = $this->conn->prepare($query);

        // Limpiar los datos
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->apellido = htmlspecialchars(strip_tags($this->apellido));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->telefono = htmlspecialchars(strip_tags($this->telefono));
        $this->participante_id = htmlspecialchars(strip_tags($this->participante_id));

        // Enlazar los valores
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":apellido", $this->apellido);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":telefono", $this->telefono);
        $stmt->bindParam(":participante_id", $this->participante_id);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Método para eliminar un participante
    public function delete() {
        // Consulta de eliminación
        $query = "DELETE FROM " . $this->table_name . " WHERE participante_id = :participante_id";

        // Preparar la consulta
        $stmt = $this->conn->prepare($query);

        // Limpiar los datos
        $this->participante_id = htmlspecialchars(strip_tags($this->participante_id));

        // Enlazar el id del participante
        $stmt->bindParam(":participante_id", $this->participante_id);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
