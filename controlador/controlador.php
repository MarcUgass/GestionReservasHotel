<?php
require_once('../modelos/conectbd.php');
require_once('../modelos/funcionesdb.php');

class ControladorSolicitud {
    private $conexion;

    public function __construct() {
        $this->conexion = conectarBD();
    }

    public function manejarSolicitud() {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['accion'])) {
            $accion = $_POST['accion'];

            if ($accion === 'registro') {
                $this->manejarRegistro();
            } elseif ($accion === 'login') {
                $this->manejarLogin();
            } else {
                echo "Acción no válida.";
            }
        } else {
            exit();
        }
    }

    private function manejarRegistro() {
        // Datos para el registro
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $dni = $_POST['dni'];
        $email = $_POST['email'];
        $clave = password_hash($_POST['clave'], PASSWORD_DEFAULT); // Asegurarse de hash la clave antes de almacenarla
        $tarjeta = $_POST['tarjeta'];

        if (!$nombre || !$apellidos || !$dni || !$email || !$clave || !$tarjeta) {
            echo "Error: Uno o más campos están vacíos.";
            exit();
        }

        // Llamar a la función registrar
        registrar($this->conexion, $nombre, $apellidos, $dni, $email, $clave, $tarjeta);
    }

    private function manejarLogin() {
        // Datos para el login
        $email = $_POST['email'];
        $clave = $_POST['clave'];

        if (!$email || !$clave) {
            echo "Error: El correo electrónico o la clave están vacíos.";
            exit();
        }

        // Llamar a la función login y almacenar el rol
        $rol = login($this->conexion, $email, $clave);
        $_SESSION['rol'] = $rol;
        #return $rol;
    }

/*    private function login($email, $clave) {
        $sql = "SELECT rol, clave FROM usuario WHERE email = ?";
        $stmt = $this->conexion->prepare($sql);
        if (!$stmt) {
            echo "Error preparando la declaración: " . $this->conexion->error;
            return null;
        }
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $hashed_clave = $row['clave'];
            $rol = $row['rol'];

            if (password_verify($clave, $hashed_clave)) {
                // Si la clave es correcta, devolvemos el rol
                return $rol;
            } else {
                echo "Error: Clave incorrecta.";
                return null;
            }
        } else {
            echo "Error: No se encontró el usuario con ese correo electrónico.";
            return null;
        }
        $stmt->close();
    }*/
}


?>
