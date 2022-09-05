<head>
<meta charset="utf-8">
</head>
<body>
<ul>
  <li><a href="principal.jsp">Principal</a></li>
    <%
      String adm = (String) request.getSession().getAttribute("acesso");
 
       if (adm.equals("Admin")) {
          %>
   <li><a href="vendasrelatorio.jsp">Relatório de vendas</a></li>         
<li class='dropdown'><a href='javascript:void(0)' class='dropbtn'>Usuários</a>
<div class='dropdown-content'><a href='usuariosrelatorio.jsp'>Relatório de Usuários</a></div></li>

<li class='dropdown'><a href='javascript:void(0)' class='dropbtn'>Eventos</a>
<div class='dropdown-content'><a href='eventosrelatorio.jsp'>Relatório de Eventos</a></div></li>            
            <%
          
        }
   %>  
  

 <li class="dropdown" style="float:right">
     <a href="javascript:void(0)" class="dropbtn">Usuário: <%=request.getSession().getAttribute("cliente")%></a>
    <div class="dropdown-content">
      <a href="deslogar.jsp">Deslogar</a>
    </div>
  </li>

</ul>

</body>