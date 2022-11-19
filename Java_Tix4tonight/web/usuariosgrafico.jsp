<%@ taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c" %>
<%@ page import="dao.Dao, dao.ClienteDao, classes.Cliente, java.util.*, org.json.JSONObject"%>
<%@ page import="dao.Dao, dao.OrganizadorDao, classes.Organizador, java.util.*, org.json.JSONObject"%>
            <%               
                int[] valores = ClienteDao.getRelatorioCliente();
                request.setAttribute("valores", valores);  


JSONObject jo = new JSONObject();
jo.put("status", true);
jo.put("dados", valores);

            %>
            
            <%               
                int[] valores2 = OrganizadorDao.getRelatorioOrganizador();
                request.setAttribute("valores2", valores2);  


JSONObject jo2 = new JSONObject();
jo.put("status", true);
jo.put("dados", valores2);

            %>
            
<%=jo%>

            