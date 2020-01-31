/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package org.me.servicio;

import com.google.gson.Gson;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import javax.jws.WebService;
import javax.jws.WebMethod;
import javax.jws.WebParam;
import javax.ejb.Stateless;

/**
 *
 * @author link
 */
@WebService(serviceName = "Servicio")
@Stateless()
public class Servicio {

    /**
     * This is a sample web service operation
     */
    @WebMethod(operationName = "hello")
    public String hello(@WebParam(name = "name") String txt) {
        return "Hello " + txt + " !";
    }

    /**
     * Web service operation
     */
    @WebMethod(operationName = "sumar")
    public Integer sumar(@WebParam(name = "num1") int num1, @WebParam(name = "num2") int num2) {
        //TODO write your implementation code here:
        return (num1+num2);
    }

    /**
     * Web service listado de alumnos
     * nombre es el filtro para acotar la busqueda
     */
    @WebMethod(operationName = "listado")
    public String listado(@WebParam(name = "nombre") String nombre) {
        //TODO write your implementation code here:
        ArrayList<Alumno> lista = new ArrayList<Alumno>();
        ControladorBD c = ControladorBD.nuevaConexionBD();
        c.abrirBD();
        ResultSet rs = c.consultarBD("Select * from alumnos  where nombre like \"%"+nombre+"%\" order by id");
        c.cerrarBD();
        try {
            while(rs.next()){
                Alumno a = new Alumno(rs.getInt("id"), rs.getString("nombre"), rs.getFloat("calificacion"));
                lista.add(a);
            }
        } catch (SQLException ex) {
           System.err.println("Servicio->Error al listar " +ex.getMessage());
           return "-99";
        }
        // Serializamos
        Gson gson = new Gson();  
        String salida = gson.toJson(lista); 
        return salida;
    }

    /**
     * Web service resultado
     * Devuelve el resultado según el tipo
     * aprbados
     * suspensos
     * media
     */
    @WebMethod(operationName = "resultado")
    public String resultado(@WebParam(name = "tipo") String tipo) {
        //TODO write your implementation code here:
        ControladorBD c = ControladorBD.nuevaConexionBD();
        c.abrirBD();
        if(tipo.equals("aprobados")){
            // sacamos el aprobados
            ResultSet rs = c.consultarBD("select COUNT(id) as aprobados from alumnos where calificacion>=5");
            c.cerrarBD(); 
            try {
                while(rs.next())
                    return (""+rs.getInt("aprobados"));

            } catch (SQLException ex) {
                System.err.println("Servicio->Error al obtener aprbados " +ex.getMessage());
                return "-98";
            }
        }else if(tipo.equals("suspensos")){
            // sacamos suspensos
            ResultSet rs = c.consultarBD("select COUNT(id) as suspensos from alumnos where calificacion<5");
            c.cerrarBD(); 
            try {
                while(rs.next())
                    return (""+rs.getInt("suspensos"));

            } catch (SQLException ex) {
                System.err.println("Servicio->Error al obtener suspensos " +ex.getMessage());
                return "-97";
            }
        }else if(tipo.equals("media")){
            // sacamos media
             ResultSet rs = c.consultarBD("select AVG(calificacion) as media from alumnos");
            c.cerrarBD(); 
            try {
                while(rs.next())
                    return (""+rs.getFloat("media"));

            } catch (SQLException ex) {
                System.err.println("Servicio->Error al obtener media " +ex.getMessage());
                return "-96";
            }
        }
        return "-95";
    }

    /**
     * Web service operation insertar
     * Inserta un usuario en la base de datos con
     * nombre y una calificacion
     */
    @WebMethod(operationName = "insertar")
    public int insertar(@WebParam(name = "nombre") String nombre, @WebParam(name = "calificacion") float calificacion) {
        //TODO write your implementation code here:
         // Habria que comprbar que no existe antes y bla bla bla bla ba
       int res = 0;
       ControladorBD c = ControladorBD.nuevaConexionBD();
       c.abrirBD();
       String consulta = "insert into alumnos (nombre, calificacion) values ('"+nombre+"','"+calificacion+"')";
       res = c.actualizarBD(consulta);
       c.cerrarBD(); 
       return res;
    }



}
