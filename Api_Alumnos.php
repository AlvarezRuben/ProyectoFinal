
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
    
<?php
$url = 'https://200.105.154.18:5901/api/Alumnos/';
$codigoUdabol = $_POST['codigoUdabol']; // Obtener el codigo de Udabol enviado desde el formulario

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // Ignorar verificación de certificado SSL
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); // Ignorar verificación de nombre del host
$response = curl_exec($curl);

if ($response !== false) {
    $data = json_decode($response, true); // Convertir la respuesta JSON en un array asociativo

    // Buscar el registro con el codigo Udabol especificado
    $alumnoEncontrado = null;
    foreach ($data as $alumno) {
        if ($alumno['codigo'] === $codigoUdabol) {
            $alumnoEncontrado = $alumno;
            break;
        }
    }

    if ($alumnoEncontrado !== null) {
        echo '<br>';
        echo '<div class="container-fluid">';
        echo '<table class="table">';
            echo '<tr><th>ID</th><th>Nombre</th><th>Primer Registro</th><th>Correo Personal</th><th>Correo Udabol</th><th>Código</th><th>Verificación</th><th>Activo</th><th>Examen Git</th><th>Examen ADOO</th><th>Examen Scrum y Transformación Digital</th><th>Examen SOLID</th><th>Examen 12 Factor App</th><th>Examen Docker</th></tr>';
             
            echo '<tr>';
            echo '<th scope="row">' . $alumnoEncontrado['id'] . '</th>';
            echo '<td>' . $alumnoEncontrado['nombre'] . '</td>';
            echo '<td>' . $alumnoEncontrado['primerRegistro'] . '</td>';
            echo '<td>' . $alumnoEncontrado['correoPersonal'] . '</td>';
            echo '<td>' . $alumnoEncontrado['correoUdabol'] . '</td>';
            echo '<td>' . $alumnoEncontrado['codigo'] . '</td>';
            echo '<td>' . $alumnoEncontrado['verificacion'] . '</td>';
            echo '<td>' . ($alumnoEncontrado['isActive'] ? "Sí" : "No") . '</td>';

            echo '<td>' . $alumnoEncontrado['ex_GIT_6PTS'] . ' puntos</td>';
            echo '<td>' . $alumnoEncontrado['ex_ADOO_8PTS'] . ' puntos</td>';
            echo '<td>' . $alumnoEncontrado['ex_ScrumTra_41PTS'] . ' puntos</td>';
            echo '<td>' . $alumnoEncontrado['ex_SOLID_8PTS'] . ' puntos</td>';
            echo '<td>' . $alumnoEncontrado['ex_12FactApp_12PTS'] . ' puntos</td>';
            echo '<td>' . $alumnoEncontrado['ex_Docker_5PTS'] . ' puntos</td>';
            
            echo '</tr>';
            
            echo '</table>';
            echo '</div>';

    } else {
        echo "No se encontró ningún alumno con el codigo Udabol especificado.";
    }
} else {
    // Manejo de errores
    echo 'Error al obtener la respuesta de la API: ' . curl_error($curl);
}

curl_close($curl);
?>

<div class="d-grid gap-2 col-6 mx-auto">
    <button onclick="window.location.href='index.php';" class="btn btn-primary">Realizar nueva búsqueda</button>
</div>



