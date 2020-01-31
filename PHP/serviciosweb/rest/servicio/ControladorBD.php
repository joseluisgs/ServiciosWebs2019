<?php

/**
 * Description of ConectorBD
 * V. 1.1
 * @author link
 */

/**
 * Conector BD usando objetos MySQLi
 */
class ControladorBD {

    // Configuración del servidor
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "aula";
    // Variables probadas
    private $bd;
    private $rs;
    // Variable instancia para Singleton
    static private $instancia = null;

    // constructor--> Private por el patrón Singleton
    private function __construct() {
        //echo "Conector creado";
    }

    /**
     * Patrón Singleton. Ontiene una instancia del Manejador de la BD
     * @return instancia de conexion
     */
    public static function getControlador() {
        if (self::$instancia == null) {
            self::$instancia = new ControladorBD();
        }
        return self::$instancia;
    }

    /**
     * Abre la conexión a la BD
     */
    public function abrirBD() {
        try {
            //$this->bd = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
            $this->bd = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            // Ponemos el modo de errores de PDO a excepciones
            $this->bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Conexión satisfactoria"; 
        } catch (PDOException $e) {
            die("conexión fallida " . $e->getMessage());
        }
    }

    /**
     * Cierra la conexión y el manejador de la BD
     */
    public function cerrarBD() {
        //$this->bd->close();
        $this->bd = null;
        $this->rs = null;
        //echo "BD cerrada";
    }

    /**
     * Actualiza la BD a través de una consulta
     * @param type $consulta
     * @return boolean
     */
    public function actualizarBD($consulta) {
        if ($this->bd->exec($consulta) != 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * REaliza una consulta a la BD
     * @param type $consulta
     * @return type ResultSet
     */
    public function consultarBD($consulta) {
        if ($this->rs = $this->bd->query($consulta)) {
            return $this->rs;
        } else {
            echo "ERROR: No se puede ejecutar consulta $consulta. " . $this->bd->error;
        }
    }

    /**
     * Devuelve los datos de conexion
     * @return type
     */
    public function datosConexion() {
        return $this->servername;
    }

    private function alerta($texto) {
        echo '<script type="text/javascript">alert("' . $texto . '")</script>';
    }

}
