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

    public function obtenerDatosHabitaciones() {
        // Lógica para obtener los datos
        require_once 'modelo.php';
    
        $total_habitaciones = obtenerTotalHabitaciones();
        $habitaciones_libres = obtenerHabitacionesLibres();
        $capacidad_total = obtenerCapacidadTotal();
        $huespedes_alojados = obtenerHuespedesAlojados();
    
        // Retornar los datos como un array asociativo
        return [
            'total_habitaciones' => $total_habitaciones,
            'habitaciones_libres' => $habitaciones_libres,
            'capacidad_total' => $capacidad_total,
            'huespedes_alojados' => $huespedes_alojados
        ];
    }

}


?>
