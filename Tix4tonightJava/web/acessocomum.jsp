    <%
       //L� dados da sess�o
       String cliente = (String) request.getSession().getAttribute("cliente");
 
       //Se n�o h� sess�o, usu�rio n�o logou, retorna para o login
        if (cliente == null) {
            response.sendRedirect("index.jsp");
        }
    %>