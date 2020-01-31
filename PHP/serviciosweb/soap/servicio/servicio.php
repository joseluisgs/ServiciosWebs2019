<?php
    require_once "nusoap.php";
    require_once "ControladorBD.php";

    // Es importante que todo lo devolvamos de la siguiente forma
    // join(",", array(XXXXX));

    /**
     * Listado de los alumnos, para evitar datos complejos u objetos
     * he decidido mapearlo con un json que sigue siendo un string que es 
     * una clase básica
     */
    function listado($nombre){
        $bd = ControladorBD::getControlador();
        $bd->abrirBD();
        $consulta = "select * from alumnos where nombre like '%".$nombre."%'";
        $filas = $bd->consultarBD($consulta);
        $bd->cerrarBD();
        $alumnos= $filas->fetchAll(PDO::FETCH_ASSOC);
        $alumnos = join(",", array(json_encode($alumnos)));
        return $alumnos;
    }
    /**
     * Ofrece un resultado del curso, a partir de un tipo
     * Podríamos hacerlo todo del tiron también y pasarlo con JSON
     * Como en el ejemplo de REST, pero no me gusta hacer lo mismo dos veces
     */
    function resultado($tipo){
        $bd = ControladorBD::getControlador();
        $bd->abrirBD();
        $res;
        if($tipo=="aprobados"){
            // sacamos el aprobados
            $consulta = "select COUNT(id) as aprobados from alumnos where calificacion>=5";
            $filas = $bd->consultarBD($consulta);
            $aprobados;
            foreach ($filas as $fila) {
                $res=$fila['aprobados'];
            }
        }else if($tipo=="suspensos"){
            // sacamos suspensos
            $consulta = "select COUNT(id) as suspensos from alumnos where calificacion <5";
            $filas = $bd->consultarBD($consulta);
            $suspensos;
            foreach ($filas as $fila) {
                $res=$fila['suspensos'];
            } 
        }else if($tipo=="media"){
            // sacamos media
            $consulta = "select AVG(calificacion) as media from alumnos";
            $filas = $bd->consultarBD($consulta);
            $media;
            foreach ($filas as $fila) {
                $res=round($fila['media'],2);
            }
        }
        $bd->cerrarBD();
        $resultado = join(",", array($res));
        return $resultado;

        // Creamos el JSON
        //$datos = [
        //    "aprobados" => $aprobados,
        //    "suspensos" => $suspensos,
        //    "media" => $media,
        //];
    }

    /**
     * Inserta un alumno en la BD
     * 1 Se inserta crrectamente
     * -1 No se inserta carrectamente
     */
    function insertar($nombre, $calificacion)
    {
        $res;
        $bd = ControladorBD::getControlador();
        $bd->abrirBD();
        $consulta = "insert into alumnos (nombre, calificacion) values ('" . $nombre . "','" . $calificacion . "')";
        echo $consulta;
        $estado = $bd->actualizarBD($consulta);
        $bd->cerrarBD();
        if(estado){
            $res = 1;
        }else{
            $res = -1;
        }
        $resultado = join(",",array($res));
        return $resultado;
    }

    // Definición de servidor
      
    $server = new soap_server();
    $server->encode_utf8 = false;
    $server->decode_utf8 = false;
    $server->soap_defencoding = 'utf-8';
    
    //Nombre y estilo del WSDL
    $servicio = "servicio";
    $estilo = "rpc"; //"document" // Puede ser cada servicio de una forma
    $codificacion = "encoded"; // literal

    // A partir de aquí registro el servicio y vamos quedando el WSLD
    // Lo registro con su espacio de nombres
    $server->configureWSDL("servicio", "urn:".$servicio);
      
    // Registro el servicio listado
    $server->register("listado",
        array("nombre" => "xsd:string"),
        array("return" => "xsd:string"),
        "urn:".$servicio,
        "urn:".$servicio."#listado",
        $estilo,
        $codificacion,
        "listado de alumnos");

    // Registro el servicio rsultados
    $server->register("resultado",
        array("tipo" => "xsd:string"),
        array("return" => "xsd:string"),
        "urn:".$servicio,
        "urn:".$servicio."#resultado",
        $estilo,
        $codificacion,
        "Resultado del curso respecto a un tipo");

    // Registro el servicio insertar
    $server->register("insertar",
        array("nombre" => "xsd:string", "calificacion" => "xsd:decimal"),
        array("return" => "xsd:integer"),
        "urn:".$servicio,
        "urn:".$servicio."#insertar",
        $estilo,
        $codificacion,
        "inserta a un alumno en la bd con su calificacion");

    if ( !isset( $HTTP_RAW_POST_DATA ) ) $HTTP_RAW_POST_DATA =file_get_contents( 'php://input' );
        $server->service($HTTP_RAW_POST_DATA);
?>