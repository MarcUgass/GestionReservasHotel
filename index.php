<?php
require 'vista/interfazUsuario.php';

session_start();

if (!isset($_COOKIE['usuario']) && !isset($_COOKIE['rol'])) {
    setcookie('usuario', 'anonimo', time() + 3600, '/');
    setcookie('rol', 'anonimo', time() + 3600, '/');
    paginaAnonimo();
}
if (isset($_COOKIE['rol']) && isset($_COOKIE['usuario'])) {
    switch ($_COOKIE['rol']) {
        case 'anonimo':
            paginaAnonimo();
            break;
        case 'admin':
            paginaAdmin();
            break;
        case 'recepcionista':
            paginaRecepcionista();
            break;
        case 'cliente':
            paginaCliente();
            break;
    }
}
?>
<?php include 'vista/footer.php'; ?>