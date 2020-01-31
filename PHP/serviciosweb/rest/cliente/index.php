<?php require_once "cabecera.php"; ?>
<?php $servidor = "http://localhost/serviciosweb/rest/servicio/servicio.php"; ?>

<div class="jumbotron">
  <h1 class="display">Cliente REST</h1>
  <p class="lead">Cliente que consume un servicio web a través de XML y JSON</p>
</div>

<!-- Listado de alumnos -->
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Listado de Alumnos XML</div>
                <div class="panel-body">
                <?php
                    // consumimos el servicio XML
                    $alumnos = simplexml_load_file($servidor."?opcion=1");
                    foreach($alumnos as $alumno){
                        echo "<li>".$alumno->id. ".- " . $alumno->nombre . ": ". $alumno->calificacion. "</li>";
                    }
                ?>
                </div>
            </div>
    </div>

    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Listado de Alumnos JSON</div>
                <div class="panel-body">
                <?php
                    // consumimos el servicio JSON
                    $json = file_get_contents($servidor."?opcion=2");
                    $alumnos = json_decode($json);
                    foreach($alumnos as $alumno){
                        echo "<li>".$alumno->id. ".- " . $alumno->nombre . ": ". $alumno->calificacion. "</li>";
                    }
                ?>
                </div>
            </div>
    </div>

</div>

<!-- Otros valores-->
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Otra información XML</div>
                <div class="panel-body">
                <?php
                    $datos = simplexml_load_file($servidor."?opcion=3");
                    foreach($datos as $dato){
                        echo "<li>Aprobados: ". $dato->aprobados . "</li>";
                        echo "<li>Suspensos: ". $dato->suspensos . "</li>";
                        echo "<li>Media: ". $dato->media . "</li>";
                    }
                ?>
                </div>
            </div>
    </div>

    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Otra información JSON</div>
                <div class="panel-body">
                <?php
                    $json = file_get_contents($servidor."?opcion=4");
                    $dato = json_decode($json);
                        echo "<li>Aprobados: ". $dato->aprobados . "</li>";
                        echo "<li>Suspensos: ". $dato->suspensos . "</li>";
                        echo "<li>Media: ". $dato->media . "</li>";
                ?>
                </div>
            </div>
    </div>

    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Insertar alumno</div>
                <div class="panel-body">
                   <form action="<?=$servidor;?>" method="post">
                    <!-- Nombre-->
                    <div class="form-group">
                        <label>Nombre:</label>
                        <input type="text" required name="nombre" class="form-control">
                    </div>
                    <!-- Calificación -->
                    <div class="form-group">
                        <label>Calificacion</label>
                        <input type="number" required name="calificacion" class="form-control" max='10' min='1' step="0.25">
                    </div>
                    <button type="submit" class="btn btn-primary"> <span class="glyphicon glyphicon-ok"></span>  Aceptar</button>
                    <button type="reset" class="btn btn-default"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                    </form>
                </div>
            </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Consultar Alumno(s)</div>
                <div class="panel-body">
                   <form action="<?=$_SERVER['PHP_SELF'];?>" method="GET">
                    <!-- Nombre-->
                    <div class="form-group">
                        <label>Nombre:</label>
                        <input type="text" required name="alumno" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary"> <span class="glyphicon glyphicon-ok"></span>  Aceptar</button>
                    <button type="reset" class="btn btn-default"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                    </form>
                    <hr>
                    <?php
                        if(isset($_GET['alumno']))
                        {
                            $al = trim($_GET['alumno']);
                            echo "<h5>Información del alumno por XML:</h5>";
                            $alumnos = simplexml_load_file($servidor."?opcion=5&alumno=".$al);
                                foreach($alumnos as $alumno){
                                    echo "<li>".$alumno->id. ".- " . $alumno->nombre . ": ". $alumno->calificacion. "</li>";
                            }
                            echo "<h5>Información del alumno por JSON:</h5>";
                            $json = file_get_contents($servidor."?opcion=6&alumno=".$al);
                            $alumnos = json_decode($json);
                            foreach($alumnos as $alumno){
                                echo "<li>".$alumno->id. ".- " . $alumno->nombre . ": ". $alumno->calificacion. "</li>";
                            }
                        }
                    ?>
                </div>
            </div>
    </div>
    </div>
    <div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Información del tiempo</div>
                <div class="panel-body">
                <?php
                    // Usando la api de https://openweathermap.org/api
                    $apiKey = "3413976168791647268ca0fe9b56bea1";
                    $cityId = "2519240";
                    $googleApiUrl = "http://api.openweathermap.org/data/2.5/weather?id=" . $cityId . "&lang=es&units=metric&APPID=" . $apiKey;
                    $ch = curl_init();
                    
                    curl_setopt($ch, CURLOPT_HEADER, 0);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                    curl_setopt($ch, CURLOPT_VERBOSE, 0);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    $response = curl_exec($ch);
                    
                    curl_close($ch);
                    $data = json_decode($response);
                    $currentTime = time();
                ?>
                <div class="report-container">
                    <h4>Información meterológica de <?php echo $data->name; ?></h4>
                        <div class="time">
                            <?php
                                date_default_timezone_set('Europe/Madrid');
                            ?>
                            <div><?php echo date("d-m-Y H:i:s", $currentTime); ?></div>
                            <div><?php echo ucwords($data->weather[0]->description); ?></div>
                        </div>
                        <div class="weather-forecast">
                        <img
                            src="http://openweathermap.org/img/w/<?php echo $data->weather[0]->icon; ?>.png"
                            class="weather-icon" /> <?php echo $data->main->temp_max; ?>°C<span
                            class="min-temperature"><?php echo $data->main->temp_min; ?>°C</span>
                        </div>
                        <div class="time">
                            <div>Humedad: <?php echo $data->main->humidity; ?> %</div>
                            <div>Viento: <?php echo $data->wind->speed; ?> km/h</div>
                        </div>
                    </div>
                </div>
            </div>
    </div>

</div>
<br><br>



<?php require_once "pie.php"; ?>