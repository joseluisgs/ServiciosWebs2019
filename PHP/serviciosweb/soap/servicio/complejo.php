<?php
    require_once('nusoap.php');
      
    function saludar($nombre) {
        $array[] = array('codigo' => '123', 'nombre' => 'test');
        $array[] = array('codigo' => '5745', 'nombre' => 'probando');
        $datos[] = $array[1];
        return $datos;
    }
    
    $namespace = "urn:complejo";
    $nombre = "saludar";

    $server = new soap_server();
    //$server->register("getProd");
    $server->configureWSDL("complejo", $namespace);
    $server->wsdl->schemaTargetNamespace = $namespace;

    $server->wsdl->addComplexType('datosBasicos', 'complexType', 'struct', 'all', '', array(
        'codigo' => array(
            'name' => 'codigo',
            'type' => 'xsd:string'
        ),
        'nombre' => array(
            'name' => 'nombre',
            'type' => 'xsd:string'
        )
    ));
    
    
    $server->wsdl->addComplexType('arraydatosBasicos', 'complexType', 'array', '', 'SOAP-ENC:Array', array(), array(
        array('ref' => 'SOAP-ENC:arrayType',
            'wsdl:arrayType' => 'tns:datosBasicos[]')
            ), 'tns:datosBasicos'
    );
    
    $server->register($nombre,
     array('nombre' => 'xsd:string'), 
     array('return' => 'tns:arraydatosBasicos'), 
     $namespace,
     $namespace.'#'.$nombre,
     "rpc",
     "encoded",
     "Nos da una lista de datos compuestos"
    );

    if ( !isset( $HTTP_RAW_POST_DATA ) ) $HTTP_RAW_POST_DATA =file_get_contents( 'php://input' );
        $server->service($HTTP_RAW_POST_DATA);
?>

