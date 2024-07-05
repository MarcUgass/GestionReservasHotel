<?php
function registrar($conn, $nombre, $apellidos, $dni, $email, $clave, $tarjeta) {
    $sql = "INSERT INTO usuario (email, clave, nombre, apellido, dni, tarjeta, rol) VALUES (?, ?, ?, ?, ?, ?, 'cliente')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssis", $email, $clave, $nombre, $apellidos, $dni, $tarjeta);

    if ($stmt->execute()) {
        header("Location: ../vista/registro_exitoso.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    logEvento($conn, $email, 'registro');

    $stmt->close();
    $conn->close();
}

function login($conn, $email, $clave) { //almacenar
    if (existeUsuario($conn, $email)){
    $sql = "SELECT rol, clave FROM usuario WHERE email = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        echo "Error preparando la declaración: " . $conn->error;
        return;
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

        $row = $result -> fetch_assoc();
        $hashed_clave = $row['clave'];
        $rol = $row['rol'];
        if (password_verify($clave, $hashed_clave)) {
            logEvento($conn, $email, 'login');
            $stmt->close();
            $conn->close();
            return $rol;
        } else {
            echo "Error: Clave incorrecta.";
            echo "num_rows: " . $stmt->num_rows;
            return null;
        }
        echo "Error: No se encontró el usuario con ese correo electrónico.";
        return null;
    $stmt->close();
    $conn->close();
} else {
    echo "Error: No se encontró el usuario con ese correo electrónico.";
    $conn->close();
    return null;
}
  
}

function existeUsuario($conexion, $email){
    // Preparar la consulta SQL para evitar inyecciones SQL
    $stmt = $conexion->prepare("SELECT email FROM usuario WHERE email = ?");
    $stmt->bind_param("s", $email); // 's' indica que el parámetro es una cadena

    // Ejecutar la consulta
    $stmt->execute();
    
    // Obtener el resultado
    $resultado = $stmt->get_result();

    // Comprobar si se obtuvo un resultado
    if($resultado->num_rows > 0){
        return true; // El usuario existe
    } else {
        return false; // El usuario no existe
    }
}


function contarUsuarios($conn) {
    $sql = "SELECT COUNT(*) as total FROM usuario";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['total'];
    } else {
        return 0;
    }
}

function mostrar_usuario($conn, $sesion) {
    $consulta = "SELECT nombre, apellido, email, rol FROM usuario WHERE email = ?";
    $stmt = $conexion->prepare($consulta);
    $stmt->bind_param("i", $usuario['id']);
    $stmt->execute();
    $resultado = $stmt->get_result();
}

function obtenerInformacionHotel($conexion) {
    $sql = "SELECT 
                (SELECT COUNT(*) FROM habitacion) AS total_habitaciones,
                (SELECT COUNT(*) FROM habitacion h WHERE NOT EXISTS (SELECT 1 FROM reserva r WHERE r.num_hab = h.numero AND r.Estado IN ('Operativa'))) AS habitaciones_libres,
                (SELECT SUM(capacidad) FROM habitacion) AS capacidad_total,
                (SELECT COUNT(*) FROM reserva WHERE Estado IN ('Operativa', 'Confirmada')) AS huespedes_alojados";
    $stmt = $conexion->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}


function obtenerTotalHabitaciones($conexion) {
    $query = "SELECT COUNT(*) AS total_habitaciones FROM habitacion";
    $resultado = $conexion->query($query);
    return $resultado->fetch_assoc()['total_habitaciones'];
}

function obtenerHabitacionesLibres($conexion) {
    $query = "SELECT COUNT(*) AS habitaciones_libres 
              FROM habitacion h 
              WHERE NOT EXISTS (
                  SELECT 1 
                  FROM reserva r 
                  WHERE r.num_hab = h.numero 
                  AND r.Estado IN ('Operativa')
              )";
    $resultado = $conexion->query($query);
    return $resultado->fetch_assoc()['habitaciones_libres'];
}

function obtenerCapacidadTotal($conexion) {
    $query = "SELECT SUM(capacidad) AS capacidad_total FROM habitacion";
    $resultado = $conexion->query($query);
    return $resultado->fetch_assoc()['capacidad_total'];
}

function obtenerHuespedesAlojados($conexion) {
    $query = "SELECT COUNT(*) AS huespedes_alojados 
              FROM reserva 
              WHERE Estado IN ('Operativa', 'Confirmada')";
    $resultado = $conexion->query($query);
    return $resultado->fetch_assoc()['huespedes_alojados'];
}

function obtenerNombre($conexion, $email){
    // Preparar la consulta SQL para evitar inyecciones SQL
    $stmt = $conexion->prepare("SELECT nombre FROM usuario WHERE email = ?");
    $stmt->bind_param("s", $email); // 's' indica que el parámetro es una cadena
    $stmt->execute();
    
    // Obtener el resultado
    $resultado = $stmt->get_result();
    if($resultado->num_rows > 0){
        return $resultado->fetch_assoc()['nombre'];
    } else {
        return null; // o manejar el caso en el que no se encuentra el email
    }
}

function obtenerApellido($conexion, $email){
    $stmt = $conexion->prepare("SELECT apellido FROM usuario WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    
    // Obtener el resultado
    $resultado = $stmt->get_result();
    if($resultado->num_rows > 0){
        return $resultado->fetch_assoc()['apellido'];
    } else {
        return null; // o manejar el caso en el que no se encuentra el email
    }
}

function obtenerEmail($conexion, $email){
    // Preparar la consulta SQL para evitar inyecciones SQL
    $stmt = $conexion->prepare("SELECT email FROM usuario WHERE email = ?");
    $stmt->bind_param("s", $email); 
    $stmt->execute();
    
    // Obtener el resultado
    $resultado = $stmt->get_result();
    if($resultado->num_rows > 0){
        return $resultado->fetch_assoc()['email'];
    } else {
        return null; // o manejar el caso en el que no se encuentra el email
    }
}

function obtenerRol($conexion, $email){
    $stmt = $conexion->prepare("SELECT rol FROM usuario WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    
    $resultado = $stmt->get_result();
    if($resultado->num_rows > 0){
        return $resultado->fetch_assoc()['rol'];
    } else {
        return null;
    }
}

function obtenerFechasDisponiblesProximos30Dias($conn, $num_hab) {
    // Obtener el día de hoy y el último día de los próximos 30 días
    $hoy = date("Y-m-d");
    $ultimoDia = date("Y-m-d", strtotime("+30 days"));

    // Consultar las reservas en la base de datos para los próximos 30 días
    $sql = "SELECT entrada, salida FROM reserva WHERE reserva.num_hab = ? AND
    ((entrada BETWEEN ? AND ?) OR 
    (salida BETWEEN ? AND ?) OR 
    (entrada <= ? AND salida >= ?))";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issssss", $num_hab, $hoy, $ultimoDia, $hoy, $ultimoDia, $hoy, $ultimoDia);
    $stmt->execute();
    $result = $stmt->get_result();


    // Guardar las fechas reservadas en un array
    $fechasReservadas = [];
    while ($row = $result->fetch_assoc()) {
        $entrada = new DateTime($row['entrada']);
        $salida = new DateTime($row['salida']);
        $salida->modify('+1 day'); // Incluir el día de salida
        $intervalo = new DateInterval('P1D');
        $periodo = new DatePeriod($entrada, $intervalo, $salida);
        foreach ($periodo as $fecha) {
            $fechasReservadas[] = $fecha->format("Y-m-d");
        }
    }

    // Generar todas las fechas desde hoy hasta los próximos 30 días
    $fechasProximos30Dias = [];
    $inicio = new DateTime($hoy);
    $fin = new DateTime($ultimoDia);
    $intervalo = new DateInterval('P1D');
    $periodo = new DatePeriod($inicio, $intervalo, $fin->modify('+1 day'));

    foreach ($periodo as $fecha) {
        $fechasProximos30Dias[] = $fecha->format("Y-m-d");
    }

    // Filtrar las fechas disponibles
    $fechasDisponibles = array_diff($fechasProximos30Dias, $fechasReservadas);

    return $fechasDisponibles;
}

function obtenerHabitaciones($conexion){
    $sql = "SELECT * FROM habitacion";
    $result = $conexion->query($sql);
    return $result;
}

function crearBackup($conexion) {
    // Obtener el listado de tablas en la base de datos
    $result = mysqli_query($conexion, 'SHOW TABLES');
    if (!$result) {
        // Error al obtener las tablas
        return false;
    }

    // Crear una cadena para almacenar el contenido del backup
    $backupContent = '';

    // Recorrer las tablas
    while ($row = mysqli_fetch_row($result)) {
        $table = $row[0];

        // Obtener la estructura de la tabla
        $tableStructure = mysqli_query($conexion, "SHOW CREATE TABLE $table");
        if (!$tableStructure) {
            // Error al obtener la estructura de la tabla
            return false;
        }

        $row = mysqli_fetch_row($tableStructure);

        // Añadir la estructura de la tabla a la cadena de contenido del backup
        $backupContent .= "DROP TABLE IF EXISTS $table;\n";
        $backupContent .= $row[1] . ";\n";

        // Obtener los datos de la tabla y añadirlos a la cadena de contenido del backup
        $tableData = mysqli_query($conexion, "SELECT * FROM $table");
        if (!$tableData) {
            // Error al obtener los datos de la tabla
            return false;
        }

        while ($rowData = mysqli_fetch_row($tableData)) {
            $backupContent .= "INSERT INTO $table VALUES ('" . implode("', '", $rowData) . "');\n";
        }

        $backupContent .= "\n";


    }

    // Devilver un array con los datos descargados
    return array("backup_content" => $backupContent);
}

function logEvento($conexion, $email, $tipo) {
    // Detectar hora y fecha actual
    $fecha = date('Y-m-d H:i:s');
    $descripcion = '';

    // Crear la descripción según el tipo de evento
    if ($tipo == 'registro') {
        $descripcion = "$email se ha registrado";
    } elseif ($tipo == 'login') {
        $descripcion = "$email ha iniciado sesión";
    } elseif ($tipo == 'logout') {
        $descripcion = "$email ha cerrado sesión";
    }

    // Preparar la consulta SQL para insertar el log en la base de datos
    $stmt = $conexion->prepare("INSERT INTO logs (email, descripcion, fecha) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $email, $descripcion, $fecha);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "Log guardado correctamente.";
    } else {
        echo "Error al guardar el log: " . $stmt->error;
    }
}

function getLogs(){

    $conexion = conectarBD();
    $sql = $conexion->prepare("SELECT * FROM logs");
    $sql->execute();
    $resultado = $sql->get_result();
    return $resultado;

}

function DB_restore($db, $f)
{
    mysqli_query($db, 'SET FOREIGN_KEY_CHECKS=0');
    DB_delete($db);
    $error = [];
    $sql = file_get_contents($f);
    $queries = explode(';', $sql);
    foreach ($queries as $q) {
        $q = trim($q);
        if ($q != '' and !mysqli_query($db, $q)){
            print_r(mysqli_error($db));
            $error .= mysqli_error($db);
        }
    }
    mysqli_commit($db);
    mysqli_query($db, 'SET FOREIGN_KEY_CHECKS=1');
    return $error;
}

function DB_delete($db)
{
    $result = mysqli_query($db, 'SHOW TABLES');
    while ($row = mysqli_fetch_row($result)){
        if ($row[0]=='usuario'){
            mysqli_query($db,"DELETE FROM usuario WHERE email!='{$_SESSION['email']}'");
        }
        else{
            mysqli_query($db,'DELETE FROM '.$row[0]);
        }
    }
    mysqli_commit($db);
}

function conectar(){
    $conexion = new mysqli("localhost", "root", "", "proyectotw");
    if($conexion->connect_error){
        die("Conexión fallida: " . $conexion->connect_error);
    }
    return $conexion;
}

function verificar_usuario($email, $clave){
    $conexion = conectar();
    $sql = "SELECT * FROM usuario WHERE email = ? AND clave = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ss", $email, $clave);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $usuario = $resultado->fetch_assoc();
    $stmt->close();
    $conexion->close();
    return $usuario;
}

//RESERVAS

function obtener_reservas(){
    $conexion = conectar();
    $sql = "SELECT * FROM reserva";
    $resultado = $conexion->query($sql);
    $reservas = array();
    while($fila = $resultado->fetch_assoc()){
        $reservas[] = $fila;
    }
    $conexion->close();
    return $reservas;
}

function obtener_habitaciones(){
    $conexion = conectar();
    $sql = "SELECT numero FROM habitacion";
    $resultado = $conexion->query($sql);
    $habitaciones = array();
    while($fila = $resultado->fetch_assoc()){
        $habitaciones[] = $fila['numero'];
    }
    $conexion->close();
    return $habitaciones;
}

function obtener_fechas_reservadas($num_hab) {
    $conexion = conectar();
    $sql = "SELECT entrada, salida FROM reserva WHERE num_hab = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $num_hab);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $fechas = array();
    while($fila = $resultado->fetch_assoc()){
        $fechas[] = array("entrada" => $fila["entrada"], "salida" => $fila["salida"]);
    }
    $stmt->close();
    $conexion->close();
    return $fechas;
}

function eliminar_reserva($email, $num_hab) {
    $conexion = conectar();
    $sql = "DELETE FROM reserva WHERE email = ? AND num_hab = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("si", $email, $num_hab);

    $resultado = $stmt->execute();
    $stmt->close();
    $conexion->close();

    return $resultado;
}

function editar_reserva($email, $num_hab, $entrada, $salida) {
    $conexion = conectar();
    $sql = "UPDATE reserva SET entrada = ?, salida = ? WHERE email = ? AND num_hab = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sssi", $entrada, $salida, $email, $num_hab);

    $resultado = $stmt->execute();
    $stmt->close();
    $conexion->close();

    return $resultado;
}

function crear_reserva($email, $num_hab, $entrada, $salida) {
    $conexion = conectar();

    // Verificar disponibilidad de la habitación
    $sql_verificar = "SELECT * FROM reserva WHERE num_hab = ? AND (entrada <= ? AND salida >= ?)";
    $stmt_verificar = $conexion->prepare($sql_verificar);
    $stmt_verificar->bind_param("iss", $num_hab, $salida, $entrada);
    $stmt_verificar->execute();
    $resultado_verificar = $stmt_verificar->get_result();

    if ($resultado_verificar->num_rows > 0) {
        $stmt_verificar->close();
        $conexion->close();
        return false; // La habitación no está disponible
    }

    $stmt_verificar->close();

    // Crear la reserva
    $sql = "INSERT INTO reserva (email, num_hab, entrada, salida) VALUES (?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("siss", $email, $num_hab, $entrada, $salida);

    $resultado = $stmt->execute();
    $stmt->close();
    $conexion->close();

    return $resultado;
}

//USUARIOS

function otbenerTodosUsuarios($conexion) {
    $sql = "SELECT * FROM usuario";
    $result = $conexion->query($sql);
    return $result;
}

function crearusuario($conn, $nombre, $apellidos, $dni, $email, $clave, $tarjeta, $rol) {
    $sql = "INSERT INTO usuario (email, clave, nombre, apellido, dni, tarjeta, rol) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssiss", $email, $clave, $nombre, $apellidos, $dni, $tarjeta, $rol);

    if (!$stmt->execute()) {
        echo "Error: " . $sql . "<br>" . $conn->error;

    }

    //logEvento($conn, $email, 'registro');
    $stmt->close();
    $conn->close();
}

function eliminar_usuario($conexion, $email) {
    $sql = "DELETE FROM usuario WHERE email = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $email);

    $resultado = $stmt->execute();
    $stmt->close();
    $conexion->close();

    return $resultado;
}

function modificarUsuario($conexion, $email_original, $email, $nombre, $apellidos, $dni, $tarjeta, $rol) {
    $sql = "UPDATE usuario SET email = ?, nombre = ?, apellido = ?, dni = ?, tarjeta = ?, rol = ? WHERE email = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssssiss", $email, $nombre, $apellidos, $dni, $tarjeta, $rol, $email_original);

    if (!$stmt->execute()) {
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }

    $stmt->close();
}

function obtenerUsuarioPorEmail($conexion, $email) {
    $sql = "SELECT * FROM usuario WHERE email = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $usuario = $result->fetch_assoc();

    $stmt->close();
    return $usuario;
}
?>