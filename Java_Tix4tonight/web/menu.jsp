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
   <li><a href="vendasrelatorio.jsp">Relat�rio de vendas</a></li>         
<li class='dropdown'><a href='javascript:void(0)' class='dropbtn'>Usu�rios</a>
<div class='dropdown-content'><a href='usuariosrelatorio.jsp'>Relat�rio de Usu�rios</a></div></li>

<li class='dropdown'><a href='javascript:void(0)' class='dropbtn'>Eventos</a>
<div class='dropdown-content'><a href='eventosrelatorio.jsp'>Relat�rio de Eventos</a></div></li>            
            <%
          
        }
   %>  
  

 <li class="dropdown" style="float:right">
     <a href="javascript:void(0)" class="dropbtn">Usu�rio: <%=request.getSession().getAttribute("cliente")%></a>
    <div class="dropdown-content">
      <a href="deslogar.jsp">Deslogar</a>
    </div>
  </li>

</ul>

</body>