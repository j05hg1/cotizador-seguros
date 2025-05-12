document.getElementById('cotizadorForm').addEventListener('submit', async function(e) {
    e.preventDefault();

    const nombre = document.getElementById('nombre').value.trim();
    const apellidos = document.getElementById('apellidos').value.trim();
    const fechaNacimiento = document.getElementById('fechaNacimiento').value;
    const placa = document.getElementById('placa').value.trim().toUpperCase();
    const errorMsg = document.getElementById('errorMsg');
    const resultadoContainer = document.getElementById('resultadoContainer');
    const resultadoTabla = document.getElementById('resultadoTabla');

    // Validación de placa
    const placaRegex = /^[A-Z]{3}[0-9]{3}$/;
    if (!placaRegex.test(placa)) {
        errorMsg.innerText = "La placa debe tener el formato ABC123 (3 letras mayúsculas y 3 números)";
        errorMsg.style.display = 'block';
        resultadoContainer.style.display = 'none';
        return;
    }

    // Ocultar mensajes previos
    errorMsg.style.display = 'none';
    resultadoContainer.style.display = 'none';
    resultadoTabla.innerHTML = '';

    // Enviar datos al backend
    try {
        const response = await fetch('http://localhost/api_sga/index.php/cotizar', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ nombre, apellidos, fechaNacimiento, placa })
        });

        if (!response.ok) {
            const errorData = await response.json();
            errorMsg.innerText = errorData.error || "Error desconocido al obtener cotización.";
            errorMsg.style.display = 'block';
            return;
        }

        const data = await response.json();

        // Mostrar resultados
        data.forEach(oferta => {
            const row = `
                <tr>
                    <td>${oferta.noCotizacion}</td>
                    <td>${oferta.placa}</td>
                    <td>${oferta.nombreProducto}</td>
                    <td>${oferta.valor}</td>
                </tr>`;
            resultadoTabla.innerHTML += row;
        });

        resultadoContainer.style.display = 'block';
    } catch (error) {
        errorMsg.innerText = "Error de red: " + error.message;
        errorMsg.style.display = 'block';
    }
});
