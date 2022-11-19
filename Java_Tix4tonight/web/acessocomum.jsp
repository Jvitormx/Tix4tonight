    <%
       //Lê dados da sessão
       String cliente = (String) request.getSession().getAttribute("cliente");
 
       //Se não há sessão, usuário não logou, retorna para o login
        if (cliente == null) {
            response.sendRedirect("index.jsp");
        }
    %>