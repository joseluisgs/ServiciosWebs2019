
package org.me.servicio;

import javax.xml.bind.annotation.XmlAccessType;
import javax.xml.bind.annotation.XmlAccessorType;
import javax.xml.bind.annotation.XmlType;


/**
 * <p>Clase Java para sumar complex type.
 * 
 * <p>El siguiente fragmento de esquema especifica el contenido que se espera que haya en esta clase.
 * 
 * <pre>
 * &lt;complexType name="sumar">
 *   &lt;complexContent>
 *     &lt;restriction base="{http://www.w3.org/2001/XMLSchema}anyType">
 *       &lt;sequence>
 *         &lt;element name="num1" type="{http://www.w3.org/2001/XMLSchema}int"/>
 *         &lt;element name="num2" type="{http://www.w3.org/2001/XMLSchema}int"/>
 *       &lt;/sequence>
 *     &lt;/restriction>
 *   &lt;/complexContent>
 * &lt;/complexType>
 * </pre>
 * 
 * 
 */
@XmlAccessorType(XmlAccessType.FIELD)
@XmlType(name = "sumar", propOrder = {
    "num1",
    "num2"
})
public class Sumar {

    protected int num1;
    protected int num2;

    /**
     * Obtiene el valor de la propiedad num1.
     * 
     */
    public int getNum1() {
        return num1;
    }

    /**
     * Define el valor de la propiedad num1.
     * 
     */
    public void setNum1(int value) {
        this.num1 = value;
    }

    /**
     * Obtiene el valor de la propiedad num2.
     * 
     */
    public int getNum2() {
        return num2;
    }

    /**
     * Define el valor de la propiedad num2.
     * 
     */
    public void setNum2(int value) {
        this.num2 = value;
    }

}
