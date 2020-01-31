/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package org.me.servicio;

/**
 *
 * @author link
 */
public class Alumno  {
    int id;
    String nombre;
    float calificacion;
    
    public Alumno(int id, String nombre, float calificacion) {
        this.id = id;
        this.nombre = nombre;
        this.calificacion = calificacion;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getNombre() {
        return nombre;
    }

    public void setNombre(String nombre) {
        this.nombre = nombre;
    }

    public float getCalificacion() {
        return calificacion;
    }

    public void setCalificacion(float calificacion) {
        this.calificacion = calificacion;
    }

    @Override
    public String toString() {
        return "Alumnos{" + "id=" + id + ", nombre=" + nombre + ", calificacion=" + calificacion + '}';
    }
    
}