<%-- 
    Document   : index
    Created on : 24-feb-2019, 12:44:50
    Author     : link
--%>

<%@page import="java.text.DecimalFormat"%>
<%@page import="com.google.gson.JsonObject"%>
<%@page import="com.google.gson.JsonElement"%>
<%@page import="com.google.gson.JsonArray"%>
<%@page import="com.google.gson.JsonParser"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@include  file="cabecera.jsp"%>
<!-- Comenzamos a programar cada sección --> 
<div class="jumbotron">
  <h1 class="display">Cliente WS SOAP</h1>
  <p class="lead">Cliente que consume un servicio web a través de SOAP y WSDL</p>
</div>

<!-- Listado de alumnos -->
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Listado de Alumnos WS-SOAP</div>
                <div class="panel-body">
                        <%-- start web service invocation --%>
                        <%
                        try {
                            org.me.servicio.Servicio_Service service = new org.me.servicio.Servicio_Service();
                            org.me.servicio.Servicio port = service.getServicioPort();
                             // TODO initialize WS operation arguments here
                            java.lang.String nombre = "";
                            // TODO process result here
                            java.lang.String result = port.listado(nombre);
                            
                            // Procesamos JSON
                            JsonParser parser = new JsonParser();
                            JsonArray gsonArr = parser.parse(result).getAsJsonArray();
                            for (JsonElement obj : gsonArr) {
                                JsonObject gsonObj = obj.getAsJsonObject();
                                String cad;
                                DecimalFormat formato = new DecimalFormat("##.00");
                                cad = gsonObj.get("id").getAsInt() + ".- " + gsonObj.get("nombre").getAsString() + ": " 
                                        + formato.format(gsonObj.get("calificacion").getAsFloat());
                                out.println("<li>"+cad+"</li>");
                            }
                        } catch (Exception ex) {
                            // TODO handle custom exceptions here
                        }
                        
                        %>
                        <%-- end web service invocation --%>
                </div>
            </div>
    </div>
<!-- Otros valores-->
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Otra información WS-SOAP</div>
                <div class="panel-body">
                    <%-- Podría llamar a los tres reitiendo el servicio 
                    cambiando el parametro tipo y llamado varias veces a port
                    pero he deicidido hacerlo arrastrando para que lo vierais --%>
                        <%-- start web service invocation --%>
                        <%
                        try {
                            org.me.servicio.Servicio_Service service = new org.me.servicio.Servicio_Service();
                            org.me.servicio.Servicio port = service.getServicioPort();
                             // TODO initialize WS operation arguments here
                            java.lang.String tipo = "aprobados";
                            // TODO process result here
                            java.lang.String result = port.resultado(tipo);
                            out.println("<li>Aprobados: "+result+"</li>");
                        } catch (Exception ex) {
                            // TODO handle custom exceptions here
                        }
                        %>
                        <%-- end web service invocation --%>
                        <%-- start web service invocation --%>
                        <%
                        try {
                            org.me.servicio.Servicio_Service service = new org.me.servicio.Servicio_Service();
                            org.me.servicio.Servicio port = service.getServicioPort();
                             // TODO initialize WS operation arguments here
                            java.lang.String tipo = "suspensos";
                            // TODO process result here
                            java.lang.String result = port.resultado(tipo);
                            out.println("<li>Suspensos: "+result+"</li>");
                        } catch (Exception ex) {
                            // TODO handle custom exceptions here
                        }
                        %>
                        <%-- end web service invocation --%>
                        <%-- start web service invocation --%>
                        <%
                        try {
                            org.me.servicio.Servicio_Service service = new org.me.servicio.Servicio_Service();
                            org.me.servicio.Servicio port = service.getServicioPort();
                             // TODO initialize WS operation arguments here
                            java.lang.String tipo = "media";
                            // TODO process result here
                            java.lang.String result = port.resultado(tipo);
                            // Dos decimales
                            float media= Float.parseFloat(result);
                            DecimalFormat formato = new DecimalFormat("##.00");
                            out.println("<li>Media: "+formato.format(media)+"</li>");
                        } catch (Exception ex) {
                            // TODO handle custom exceptions here
                        }
                        %>
                        <%-- end web service invocation --%>
                </div>
            </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Insertar alumno</div>
                <div class="panel-body">
                   <form action="index.jsp" method="POST">
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
                    <hr>
                    <% 
                        // Si existen los parámetros vía POST
                        if(request.getParameterMap().containsKey("nombre") && request.getParameterMap().containsKey("calificacion")){
                            String nom =  request.getParameter("nombre");
                            float cal =  Float.parseFloat(request.getParameter("calificacion"));
                            //out.println(nombre + calificacion);
                            // Invocamos al servicio
                            //<%-- start web service invocation --
                            //
                            try {
                                org.me.servicio.Servicio_Service service = new org.me.servicio.Servicio_Service();
                                org.me.servicio.Servicio port = service.getServicioPort();
                                 // TODO initialize WS operation arguments here
                                java.lang.String nombre = nom;
                                float calificacion = cal;
                                // TODO process result here
                                int result = port.insertar(nombre, calificacion);
                                out.println("Insertado = "+result);
                                
                            } catch (Exception ex) {
                                // TODO handle custom exceptions here
                            }
                            // Refrescamos
                            // Nos movemos a una nueva dirección, que somos nosotros mismos
                            String sitio = request.getHeader("Referer");
                            response.setStatus(response.SC_MOVED_TEMPORARILY);
                            response.setHeader("Location", sitio); 
                            //<%-- end web service invocation --   
                        }
                    %>
                        
                </div>
            </div>
    </div>
<div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Consultar Alumno(s) WS-SOAP</div>
                <div class="panel-body">
                   <form action="index.jsp" method="GET">
                    <!-- Nombre-->
                    <div class="form-group">
                        <label>Nombre:</label>
                        <input type="text" required name="alumno" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary"> <span class="glyphicon glyphicon-ok"></span>  Aceptar</button>
                    <button type="reset" class="btn btn-default"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                    </form>
                    <hr>
                    <%
                        if(request.getParameterMap().containsKey("alumno")){
                            String al =  request.getParameter("alumno");
                            //out.println(al);
                            //<%-- start web service invocation --
                        try {
                            org.me.servicio.Servicio_Service service = new org.me.servicio.Servicio_Service();
                            org.me.servicio.Servicio port = service.getServicioPort();
                             // TODO initialize WS operation arguments here
                            java.lang.String nombre = al;
                            // TODO process result here
                            java.lang.String result = port.listado(nombre);
                            
                            // Procesamos JSON
                            JsonParser parser = new JsonParser();
                            JsonArray gsonArr = parser.parse(result).getAsJsonArray();
                            for (JsonElement obj : gsonArr) {
                                JsonObject gsonObj = obj.getAsJsonObject();
                                String cad;
                                DecimalFormat formato = new DecimalFormat("##.00");
                                cad = gsonObj.get("id").getAsInt() + ".- " + gsonObj.get("nombre").getAsString() + ": " 
                                        + formato.format(gsonObj.get("calificacion").getAsFloat());
                                out.println("<li>"+cad+"</li>");
                            }
                        } catch (Exception ex) {
                            // TODO handle custom exceptions here
                        }
                        

                        //-- end web service invocation --
                        }
                    %>
                </div>
            </div>
    </div>
</div>


<br><br>
<!-- Final de la página -->
<%@include  file="pie.jsp"%>