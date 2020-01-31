
package org.me.servicio;

import javax.xml.bind.JAXBElement;
import javax.xml.bind.annotation.XmlElementDecl;
import javax.xml.bind.annotation.XmlRegistry;
import javax.xml.namespace.QName;


/**
 * This object contains factory methods for each 
 * Java content interface and Java element interface 
 * generated in the org.me.servicio package. 
 * <p>An ObjectFactory allows you to programatically 
 * construct new instances of the Java representation 
 * for XML content. The Java representation of XML 
 * content can consist of schema derived interfaces 
 * and classes representing the binding of schema 
 * type definitions, element declarations and model 
 * groups.  Factory methods for each of these are 
 * provided in this class.
 * 
 */
@XmlRegistry
public class ObjectFactory {

    private final static QName _Hello_QNAME = new QName("http://servicio.me.org/", "hello");
    private final static QName _HelloResponse_QNAME = new QName("http://servicio.me.org/", "helloResponse");
    private final static QName _Insertar_QNAME = new QName("http://servicio.me.org/", "insertar");
    private final static QName _InsertarResponse_QNAME = new QName("http://servicio.me.org/", "insertarResponse");
    private final static QName _Listado_QNAME = new QName("http://servicio.me.org/", "listado");
    private final static QName _ListadoResponse_QNAME = new QName("http://servicio.me.org/", "listadoResponse");
    private final static QName _Resultado_QNAME = new QName("http://servicio.me.org/", "resultado");
    private final static QName _ResultadoResponse_QNAME = new QName("http://servicio.me.org/", "resultadoResponse");
    private final static QName _Sumar_QNAME = new QName("http://servicio.me.org/", "sumar");
    private final static QName _SumarResponse_QNAME = new QName("http://servicio.me.org/", "sumarResponse");

    /**
     * Create a new ObjectFactory that can be used to create new instances of schema derived classes for package: org.me.servicio
     * 
     */
    public ObjectFactory() {
    }

    /**
     * Create an instance of {@link Hello }
     * 
     */
    public Hello createHello() {
        return new Hello();
    }

    /**
     * Create an instance of {@link HelloResponse }
     * 
     */
    public HelloResponse createHelloResponse() {
        return new HelloResponse();
    }

    /**
     * Create an instance of {@link Insertar }
     * 
     */
    public Insertar createInsertar() {
        return new Insertar();
    }

    /**
     * Create an instance of {@link InsertarResponse }
     * 
     */
    public InsertarResponse createInsertarResponse() {
        return new InsertarResponse();
    }

    /**
     * Create an instance of {@link Listado }
     * 
     */
    public Listado createListado() {
        return new Listado();
    }

    /**
     * Create an instance of {@link ListadoResponse }
     * 
     */
    public ListadoResponse createListadoResponse() {
        return new ListadoResponse();
    }

    /**
     * Create an instance of {@link Resultado }
     * 
     */
    public Resultado createResultado() {
        return new Resultado();
    }

    /**
     * Create an instance of {@link ResultadoResponse }
     * 
     */
    public ResultadoResponse createResultadoResponse() {
        return new ResultadoResponse();
    }

    /**
     * Create an instance of {@link Sumar }
     * 
     */
    public Sumar createSumar() {
        return new Sumar();
    }

    /**
     * Create an instance of {@link SumarResponse }
     * 
     */
    public SumarResponse createSumarResponse() {
        return new SumarResponse();
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link Hello }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "http://servicio.me.org/", name = "hello")
    public JAXBElement<Hello> createHello(Hello value) {
        return new JAXBElement<Hello>(_Hello_QNAME, Hello.class, null, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link HelloResponse }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "http://servicio.me.org/", name = "helloResponse")
    public JAXBElement<HelloResponse> createHelloResponse(HelloResponse value) {
        return new JAXBElement<HelloResponse>(_HelloResponse_QNAME, HelloResponse.class, null, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link Insertar }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "http://servicio.me.org/", name = "insertar")
    public JAXBElement<Insertar> createInsertar(Insertar value) {
        return new JAXBElement<Insertar>(_Insertar_QNAME, Insertar.class, null, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link InsertarResponse }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "http://servicio.me.org/", name = "insertarResponse")
    public JAXBElement<InsertarResponse> createInsertarResponse(InsertarResponse value) {
        return new JAXBElement<InsertarResponse>(_InsertarResponse_QNAME, InsertarResponse.class, null, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link Listado }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "http://servicio.me.org/", name = "listado")
    public JAXBElement<Listado> createListado(Listado value) {
        return new JAXBElement<Listado>(_Listado_QNAME, Listado.class, null, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link ListadoResponse }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "http://servicio.me.org/", name = "listadoResponse")
    public JAXBElement<ListadoResponse> createListadoResponse(ListadoResponse value) {
        return new JAXBElement<ListadoResponse>(_ListadoResponse_QNAME, ListadoResponse.class, null, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link Resultado }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "http://servicio.me.org/", name = "resultado")
    public JAXBElement<Resultado> createResultado(Resultado value) {
        return new JAXBElement<Resultado>(_Resultado_QNAME, Resultado.class, null, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link ResultadoResponse }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "http://servicio.me.org/", name = "resultadoResponse")
    public JAXBElement<ResultadoResponse> createResultadoResponse(ResultadoResponse value) {
        return new JAXBElement<ResultadoResponse>(_ResultadoResponse_QNAME, ResultadoResponse.class, null, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link Sumar }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "http://servicio.me.org/", name = "sumar")
    public JAXBElement<Sumar> createSumar(Sumar value) {
        return new JAXBElement<Sumar>(_Sumar_QNAME, Sumar.class, null, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link SumarResponse }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "http://servicio.me.org/", name = "sumarResponse")
    public JAXBElement<SumarResponse> createSumarResponse(SumarResponse value) {
        return new JAXBElement<SumarResponse>(_SumarResponse_QNAME, SumarResponse.class, null, value);
    }

}
