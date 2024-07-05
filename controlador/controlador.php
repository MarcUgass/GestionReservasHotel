<?php
require_once(__DIR__ .'/../modelos/conectbd.php');
require_once(__DIR__ .'/../modelos/funcionesdb.php');

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
    public function manejarUsuario() {
                // Manejar las acciones de los formularios
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    if (isset($_POST['modificar'])) {
                        $email = $_POST['email'];
                        ob_start();
                        modificarUsuariopagina($email);
                        ob_end_flush();
                        exit();
                    }
                    if (isset($_POST['borrar'])) {
                        $email = $_POST['email'];
                        if (eliminar_usuario($this->conexion, $email)){
                            echo "<p>Usuario con email: $email eliminado exitosamente</p>";
                            }
                            else {
                                echo "<p>No se pudo borrar el usuario con email: $email</p>";
                            }
                    }
                    if (isset($_POST['crear'])) {
                        $nombre = $_POST['nombre'];
                        $apellidos = $_POST['apellidos'];
                        $dni = $_POST['dni'];
                        $email = $_POST['email'];
                        $clave = password_hash($_POST['clave'], PASSWORD_DEFAULT); // Asegurarse de hash la clave antes de almacenarla
                        $tarjeta = $_POST['tarjeta'];
                        $rol = $_POST['rol'];

                        if (!$nombre || !$apellidos || !$dni || !$email || !$clave || !$tarjeta) {
                            echo "Error: Uno o más campos están vacíos.";
                            exit();
                        }

                        // Llamar a la función registrar
                        crearUsuario($this->conexion, $nombre, $apellidos, $dni, $email, $clave, $tarjeta, $rol);
                    }
                    if (isset($_POST['guardar'])) {
                        $email_original = $_POST['email_original'];
                        $email = $_POST['email'];
                        $nombre = $_POST['nombre'];
                        $apellidos = $_POST['apellidos'];
                        $dni = $_POST['dni'];
                        $tarjeta = $_POST['tarjeta'];
                        $rol = $_POST['rol'];
        
                        modificarUsuario($this->conexion, $email_original, $email, $nombre, $apellidos, $dni, $tarjeta, $rol);
                    }
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
        $_SESSION['email'] = $email;
        #return $rol;
    }

    public function obtenerDatosHabitaciones() {
        // Lógica para obtener los datos
    
        $total_habitaciones = obtenerTotalHabitaciones($this->conexion);
        $habitaciones_libres = obtenerHabitacionesLibres($this->conexion);
        $capacidad_total = obtenerCapacidadTotal($this->conexion);
        $huespedes_alojados = obtenerHuespedesAlojados($this->conexion);
    
        // Retornar los datos como un array asociativo
        return [
            'total_habitaciones' => $total_habitaciones,
            'habitaciones_libres' => $habitaciones_libres,
            'capacidad_total' => $capacidad_total,
            'huespedes_alojados' => $huespedes_alojados
        ];
    }

    public function obtenerDatosUsuario($email) {
        $nombre = obtenerNombre($this->conexion, $email);
        $apellido = obtenerApellido($this->conexion, $email);
        $email = obtenerEmail($this->conexion, $email);
        $rol = obtenerRol($this->conexion, $email);
    
        // Retornar los datos como un array asociativo
        return [
            'nombre' => $nombre,
            'apellido' => $apellido,
            'email' => $email,
            'rol' => $rol
        ];
    }

    function obtenerlistaHabitaciones() {
        $result = obtenerHabitaciones($this->conexion);
        return $result;
    }

    function obtener30dias(){
        $result = obtenerFechasDisponiblesProximos30Dias($this->conexion, $_GET['num_hab']);
        return $result;
    }

    function getBD(){
        return $this->conexion;
    }

    function obtenerlistaUsuarios(){
        $result = otbenerTodosUsuarios($this->conexion);
        return $result;
    }

    public function obtenerUsuarioPorEmail($email) {
        return obtenerUsuarioPorEmail($this->conexion, $email);
    }

}
?>
