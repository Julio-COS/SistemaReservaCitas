<?php
class Auth {
    private $conn;
    private $table_name = "persona";

    public $id;
    public $nombres;
    public $apellidos;
    public $username;
    public $password;
    public $correo;
    public $role_id;

    public $usuario;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Función para login
    public function login() {
        $query = "SELECT persona_id, username, password, role_id FROM " . $this->table_name . " WHERE username = :username";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $this->username);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($this->password, $user['password'])) {
            $this->id = $user['persona_id'];
            $this->role_id = $user['role_id'];
            return true;
        }
        return false;
    }

    // Función para obtener el rol del usuario
    public function getRole() {
        $query = "SELECT role_name FROM roles WHERE role_id = :role_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':role_id', $this->role_id);
        $stmt->execute();
        $role = $stmt->fetch(PDO::FETCH_ASSOC);
        return $role['role_name'];
    }

    // Función para registrar un nuevo usuario
    public function register() {
        $query = "INSERT INTO " . $this->table_name . " 
                  (nombres, apellidos, username, password, correo, role_id) 
                  VALUES (:nombres, :apellidos, :username, :password, :correo, :role_id)";

        $stmt = $this->conn->prepare($query);

        // Encriptar la contraseña
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);

        // Asignar valores
        $stmt->bindParam(':nombres', $this->nombres);
        $stmt->bindParam(':apellidos', $this->apellidos);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':correo', $this->correo);
        $stmt->bindParam(':role_id', $this->role_id);

        // Ejecutar el query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }


    public function getUsuarios($pagina,$limit){
        $offset= ($pagina-1) * $limit;
        //data        
        $query = "SELECT a.persona_id, a.nombres, a.apellidos, a.correo, b.role_name AS rol FROM " . $this->table_name ." a 
        INNER JOIN roles b on a.role_id = b.role_id
        ORDER BY a.persona_id ASC
        LIMIT $limit OFFSET $offset";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //paginacion
        $countQuery= "SELECT COUNT(*) as total FROM ". $this->table_name;
        $countStmt = $this->conn->prepare($countQuery);
        $countStmt->execute();
        $total = $countStmt->fetch(PDO::FETCH_ASSOC)['total'];

        return [
            'data' => $data,
            'total' => $total,
            'total_pages' => ceil($total / $limit)
        ];
    }
    public function getUsuario($id){
        $query = "SELECT * FROM " . $this->table_name ." WHERE persona_id = $id LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function update() {

        $query = "UPDATE " . $this->table_name . " SET 
                    nombres	 = :nombres	, 
                    apellidos = :apellidos, 
                    username  = :username, 
                    password = :password, 
                    correo = :correo, 
                    role_id = :role_id
                  WHERE persona_id like :persona_id";

        $stmt = $this->conn->prepare($query);
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
        
        $this->nombres = htmlspecialchars(strip_tags($this->nombres));
        $this->apellidos = htmlspecialchars(strip_tags($this->apellidos));
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->correo = htmlspecialchars(strip_tags($this->correo));
        $this->role_id = htmlspecialchars(strip_tags($this->role_id));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':nombres', $this->nombres);
        $stmt->bindParam(':apellidos', $this->apellidos);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':correo', $this->correo);
        $stmt->bindParam(':role_id', $this->role_id);
        $stmt->bindParam(':persona_id', $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE persona_id = ?";
        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(1, $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    
}
?>
