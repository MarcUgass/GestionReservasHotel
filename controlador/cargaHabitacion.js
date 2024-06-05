function cargarInformacionHotel() {
    fetch('controlador.php', {
        method: 'POST',
        body: JSON.stringify({ accion: 'obtenerInformacionHotel' }), // Enviar la acción al controlador
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('total_habitaciones').innerText = data.total_habitaciones;
        document.getElementById('habitaciones_libres').innerText = data.habitaciones_libres;
        document.getElementById('capacidad_total').innerText = data.capacidad_total;
        document.getElementById('huespedes_alojados').innerText = data.huespedes_alojados;
    })
    .catch(error => console.error("Error:", error));
}

document.addEventListener('DOMContentLoaded', cargarInformacionHotel);
