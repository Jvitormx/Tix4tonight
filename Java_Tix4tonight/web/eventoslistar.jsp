<%@page import="org.json.JSONArray"%>
<%@page import="classes.Evento"%>
<%@page import="dao.EventosDao"%>
<%@page import="java.util.List"%>

            <%                 
                List<Evento> list = EventosDao.getEventos();
                request.setAttribute("list", list);
 
JSONArray ja = new JSONArray(list);
            %>
            <%=ja%>
