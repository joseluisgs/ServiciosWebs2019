<?php require_once "ControladorBD.php"; ?>
<?php

error_reporting(E_ALL ^ E_NOTICE);

    // Metodo Post para insertar
    if(isset($_POST['nombre']) && isset($_POST['calificacion'])){
        $nombre = trim($_POST['nombre']);
        $calificacion= trim($_POST['calificacion']);

        $bd = ControladorBD::getControlador();
        $bd->abrirBD();
        $consulta = "insert into alumnos (nombre, calificacion) values ('" . $nombre . "','" . $calificacion . "')";
        echo $consulta;
        $estado = $bd->actualizarBD($consulta);
        $bd->cerrarBD();
        if(estado){
            header("location: /serviciosweb/rest/cliente/");
            exit();
        }else{
            echo "ERROR";
            exit();
        }
    }
    // Aunqe el parámeyro alumno es global al scripto lo paso por aclarar de donde vienen lso datos
    if(isset($_GET['alumno']))
    {
        $alumno = $_GET['alumno'];
    }

    // Metodo get con las opción para devolver
    if(isset($_GET['opcion']))
    {
        $opcion = $_GET['opcion'];
    }
        switch ($opcion) {
        case '1':
            listadoXML();
            break;

        case '2':
            listadoJSON();
            break;

        case '3':
            otrosXML();
            break;

        case '4':
            otrosJSON();
            break;
        case '5':
            alumnoXML($alumno);
            break;

        case '6':
            alumnoJSON($alumno);
            break;
        
        default:
            # code...
            break;
    }
    /**
     * Muestra el listado de los alumnos en PHP
     */

    function listado(){
        $bd = ControladorBD::getControlador();
        $bd->abrirBD();
        $consulta = "select * from alumnos";
        $filas = $bd->consultarBD($consulta);
        $bd->cerrarBD();
        return $filas;
    }
    
    
    

    function listadoXML(){
        $filas = listado();
        // Creamos el XML con DOM
        $doc = new DOMDocument('1.0', 'UTF-8');
        $alumnos = $doc->createElement('alumnos');

        foreach ($filas as $fila) {
            $alumno = $doc->createElement('alumno');
            //$alumno->setAttribute('id', $fila['id']);
            $alumno->appendChild($doc->createElement('id', $fila['id']));
            $alumno->appendChild($doc->createElement('nombre', $fila['nombre']));
            $alumno->appendChild($doc->createElement('calificacion', $fila['calificacion']));

            //Insertamos
            $alumnos->appendChild($alumno);
        }

        $doc->appendChild($alumnos);
        header('Content-type: application/xml');
        echo $doc->saveXML();
        exit;
    }

    /**
     * Muestra el listado de los alumnos en PHP
     */
    function listadoJSON(){
        $filas = listado();
        $alumnos= $filas->fetchAll(PDO::FETCH_ASSOC);
        header('Content-type: application/json');
        echo json_encode($alumnos);
        exit;
    }

    function otrosXML(){
        $bd = ControladorBD::getControlador();
        $bd->abrirBD();
        // sacamos el aprobados
        $consulta = "select COUNT(id) as aprobados from alumnos where calificacion>=5";
        $filas = $bd->consultarBD($consulta);
        $aprobados;
        foreach ($filas as $fila) {
            $aprobados=$fila['aprobados'];
        }
         // sacamos suspensos
         $consulta = "select COUNT(id) as suspensos from alumnos where calificacion <5";
         $filas = $bd->consultarBD($consulta);
         $suspensos;
         foreach ($filas as $fila) {
             $suspensos=$fila['suspensos'];
         }

          // sacamos media
        $consulta = "select AVG(calificacion) as media from alumnos";
        $filas = $bd->consultarBD($consulta);
        $media;
        foreach ($filas as $fila) {
            $media=round($fila['media'],2);
        }
        $bd->cerrarBD();

        // Creamos el XML
        $doc = new DOMDocument('1.0', 'UTF-8');
        $datos = $doc->createElement('datos');
        // Los datos
            $dato = $doc->createElement('dato');
                $dato->appendChild($doc->createElement('aprobados', $aprobados));
                $dato->appendChild($doc->createElement('suspensos', $suspensos));
                $dato->appendChild($doc->createElement('media', $media));
            $datos->appendChild($dato);
        $doc->appendChild($datos);
        header('Content-type: application/xml');
        echo $doc->saveXML();
        exit;
    }

    function otrosJSON(){
        $bd = ControladorBD::getControlador();
        $bd->abrirBD();
        // sacamos el aprobados
        $consulta = "select COUNT(id) as aprobados from alumnos where calificacion>=5";
        $filas = $bd->consultarBD($consulta);
        $aprobados;
        foreach ($filas as $fila) {
            $aprobados=$fila['aprobados'];
        }
         // sacamos suspensos
         $consulta = "select COUNT(id) as suspensos from alumnos where calificacion <5";
         $filas = $bd->consultarBD($consulta);
         $suspensos;
         foreach ($filas as $fila) {
             $suspensos=$fila['suspensos'];
         }

          // sacamos media
        $consulta = "select AVG(calificacion) as media from alumnos";
        $filas = $bd->consultarBD($consulta);
        $media;
        foreach ($filas as $fila) {
            $media=round($fila['media'],2);
        }
        $bd->cerrarBD();

        // Creamos el JSON
        $datos = [
            "aprobados" => $aprobados,
            "suspensos" => $suspensos,
            "media" => $media,
        ];
        header('Content-type: application/json');
        echo json_encode($datos);
        exit;
    }

    function alumnoXML($alumno)
    {
        $bd = ControladorBD::getControlador();
        $bd->abrirBD();
        $consulta = "select * from alumnos where nombre like '%".$alumno."%'";
        //echo $consulta;
        $filas = $bd->consultarBD($consulta);
        $bd->cerrarBD();

        // Creamos el XML con DOM
        $doc = new DOMDocument('1.0', 'UTF-8');
        $alumnos = $doc->createElement('alumnos');

        foreach ($filas as $fila) {
            $alumno = $doc->createElement('alumno');
                $alumno->appendChild($doc->createElement('id', $fila['id']));
                $alumno->appendChild($doc->createElement('nombre', $fila['nombre']));
                $alumno->appendChild($doc->createElement('calificacion', $fila['calificacion']));

            //Insertamos
            $alumnos->appendChild($alumno);
        }

        $doc->appendChild($alumnos);
        header('Content-type: application/xml');
        echo $doc->saveXML();
        exit;
    }

    function alumnoJSON($alumno)
    {
        $bd = ControladorBD::getControlador();
        $bd->abrirBD();
        $consulta = "select * from alumnos where nombre like '%".$alumno."%'";
        //echo $consulta;
        $filas = $bd->consultarBD($consulta);
        $bd->cerrarBD();
        // Mando
        $alumnos= $filas->fetchAll(PDO::FETCH_ASSOC);
        header('Content-type: application/json');
        echo json_encode($alumnos);
        exit;
    }


?>