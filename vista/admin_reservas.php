<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel XYZ - Administración de Reservas</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Hotel XYZ</h1>
        <nav>
            <ul>
                <li><a href="index.html">Inicio</a></li>
                <li><a href="servicios.html">Servicios</a></li>
                <li><a href="habitaciones.html">Habitaciones</a></li>
                <li><a href="registro.html">Registro</a></li>
                <li><a href="reservas.html">Reservas</a></li>
                <li><a href="admin_reservas.html">Administrar Reservas</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <main>
            <section>
                <h2>Administración de Reservas</h2>
                <table>
                    <tr>
                        <th>Habitación</th>
                        <th>Cliente</th>
                        <th>Fecha de Entrada</th>
                        <th>Fecha de Salida</th>
                        <th>Acciones</th>
                    </tr>
                    <tr>
                        <td>101</td>
                        <td>Juan Pérez</td>
                        <td>01/06/2023</td>
                        <td>07/06/2023</td>
                        <td><button>Eliminar</button></td>
                    </tr>
                    <tr>
                        <td>102</td>
                        <td>Maria Gómez</td>
                        <td>02/06/2023</td>
                        <td>08/06/2023</td>
                        <td><button>Eliminar</button></td>
                    </tr>
                </table>
            </section>
        </main>
        <aside>
            <h3>Información del Hotel</h3>
            <p>Número total de habitaciones: 100</p>
            <p>Número de habitaciones libres: 20</p>
            <p>Capacidad total del hotel: 200 huéspedes</p>
            <p>Número de huéspedes alojados: 180</p>
        </aside>
    </div>
    <footer>
        <p>&copy; 2023 Hotel XYZ. Todos los derechos reservados.</p>
        <p>Autor: [Tu Nombre]</p>
        <p><a href="documentacion.pdf">Documentación del Proyecto</a></p>
    </footer>
</body>
</html>
