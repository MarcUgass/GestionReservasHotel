<?php
require 'vista/interfazUsuario.php';

session_start();
// Verificamos si $_SESSION['rol'] está definido
if (isset($_SESSION['rol'])) {
    $rol = $_SESSION['rol'];
    
    // Redirigimos según el rol usando switch
    switch ($rol) {
        case 'admin':
            paginaAdmin($_SESSION['email']);
            break;
        case 'recepcionista':
            paginaRecepcionista($_SESSION['email']);
            break;
        case 'cliente':
            paginaCliente($_SESSION['email']);
            #$usuario = new usuario($_SESSION['email'], $_SESSION['clave'], $_SESSION['rol']);
            break;
        default:
            paginaAnonimo();
            break;
    }
} else {
    // Si $_SESSION['rol'] no está definido, mostramos un error o redirigimos a una página predeterminada
    paginaAnonimo();
}
?>
<?php include 'vista/footer.php'; ?>