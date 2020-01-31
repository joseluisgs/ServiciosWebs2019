/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package clientesoap;

import java.io.File;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import javax.swing.JOptionPane;

/**
 *
 * @author link
 */
public class ControladorBD {
    private java.sql.Connection conexion; 
    private java.sql.Statement consulta; //ExecuteQuery --> Solo para selects (El resultado se guarda en Conj_Registros) ; ExecuteUpdate --> para todo lo demas
    private java.sql.ResultSet resultado; // --> Esta variable se usa solo para los resultados de las selects
    
    private String ruta;
    private String bbdd;
    private String servidor;
    private String puerto;
    private String usuario;
    private String clave;
    
    private static ControladorBD bd;
    
    // Constructor BD privado --> Singleton
    private ControladorBD() {
        this.bbdd = "aula"; // Nombre de la base de datos en SQLite es el fichero
        this.usuario = "root"; // No tenemos en SQLite
        this.clave = ""; // No tenemos en SQLite
        this.servidor="localhost"; // Ip del servidor en MySQL o MariaDB
        this.puerto="3306"; // Puerto de conexión para el servidor de MYSQL o MariaDB
        //this.ruta =getPathBaseDatos(); // Path o camino del fichero en SQLlite
        
        
        //System.out.println("Mi nombre es: " + this.nombre);
    }
    
    // Creador de instancias --> Singleton
    public static ControladorBD nuevaConexionBD() {
        if (bd == null){
            bd = new ControladorBD();
        }
        else{
            //System.out.println("No se puede crear el objeto "+ nombre + " porque ya existe un objeto de la clase SoyUnico");
        }       
        return bd;
    }
    
    // Metodo para abrir la Conexion la Base de Datos
    public void abrirBD() {
       // String conector ="org.sqlite.JDBC"; // MySQL: "com.mysql.jdbc.Driver"
        String conector = "org.mariadb.jdbc.Driver"; // Vamos a usat MariaDB la version libre de MySQL
        try {
            Class.forName(conector);
	}
	catch (ClassNotFoundException e) {
            //JOptionPane.showMessageDialog(null, e.getMessage(),"Error de conexion",JOptionPane.ERROR_MESSAGE);
            System.err.println(e.getMessage());
	}	 
        try {
            //String url = "jdbc:sqlite:"+this.ruta+this.bbdd; //MySQL jdbc:mysql://localhost/prueba", "root", "1daw"
            String url = "jdbc:mariadb://"+this.servidor+":"+this.puerto+"/"+this.bbdd+"";
            //System.out.println(url);
            //conexion = DriverManager.getConnection(url);
            conexion = DriverManager.getConnection(url, usuario,clave);
            consulta = conexion.createStatement();// Para que aenviar consultas a la BD, objeto Statement
            // System.out.println("Conectado de la Base de Datos"); // Opcional para seguridad
	} catch (SQLException e) {
             System.err.println(e.getMessage());
             //JOptionPane.showMessageDialog(null, e.getMessage(),"Error de conexion",JOptionPane.ERROR_MESSAGE);
        }
    }
    
    public void cerrarBD(){
        try {
           // resultado.close();
            conexion.close();
            // System.out.println("Desconectado de la Base de Datos"); // Opcional para seguridad
        } catch (SQLException ex) {
            System.err.println(ex.getMessage());
             //JOptionPane.showMessageDialog(null, ex.getMessage(),"Error de Desconexion",JOptionPane.ERROR_MESSAGE);
        }
    }
    
    public ResultSet consultarBD(String sql){
        
        resultado = null; // Limpiamos lo que hay
        try {
            resultado = consulta.executeQuery(sql);

        } catch (SQLException e) {
                System.err.println("Mensaje:"+e.getMessage());
                System.err.println("Estado:"+e.getSQLState());
                System.err.println("Codigo del error:"+e.getErrorCode());
                System.err.println(e.getMessage());
                //JOptionPane.showMessageDialog(null, "Mensaje:"+e.getMessage()+"\nEstado: "+e.getSQLState()+"\nCodigo de error:"+e.getErrorCode(),
                //        "Error de consulta",JOptionPane.ERROR_MESSAGE);
        }
        return resultado;
        
    }
    
    public int actualizarBD(String sql){
        int valor = 0;
        try {
            valor=consulta.executeUpdate(sql);
        }catch (SQLException e) {
            valor = 0;
            System.err.println("Mensaje:"+e.getMessage());
            System.err.println("Estado:"+e.getSQLState());
            System.err.println("Codigo del error:"+e.getErrorCode());
            System.err.println(e.getMessage());
             //JOptionPane.showMessageDialog(null, "Mensaje:"+e.getMessage()+"\nEstado: "+e.getSQLState()+"\nCodigo de error:"+e.getErrorCode(),
             //           "Error de consulta",JOptionPane.ERROR_MESSAGE);
        }      
        return valor;
    }
    
    // Para trabajar con SQLite
    private String getPathBaseDatos() {
        // Path Actual, directorio de la BD
        String path = System.getProperty("user.dir");
        // usamos path separator para mejorar la detección del path del sistem,a
        String pathBD = path+File.separator+"BD"+File.separator;
        return pathBD;   
    }

    
}
