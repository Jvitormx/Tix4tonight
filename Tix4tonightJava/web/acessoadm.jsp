    <%
       //Lê dados da sessão 
       String acesso = (String) request.getSession().getAttribute("acesso");
       
       //Verifica se o acesso é de administrador
        if (!acesso.equals("Admin")) {
            response.sendRedirect("principal.jsp");
        }
    %>
