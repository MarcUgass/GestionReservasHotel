<?php
require 'vista/anonimo.php';
require 'vista/cliente.php';

session_start();
// Verificamos si $_SESSION['rol'] está definido
if (isset($_SESSION['rol'])) {
    $rol = $_SESSION['rol'];

    // Redirigimos según el rol usando switch
    switch ($rol) {
        case 'administrador':
            paginaAdmin();
            break;
        case 'recepcionista':
            paginaUsuario();
            break;
        case 'cliente':
            paginaCliente();
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