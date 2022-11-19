<%@ taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c" %>
<%@ page import="dao.Dao, dao.ClienteDao, classes.Cliente, java.util.*"%>
<%@ page import="dao.Dao, dao.OrganizadorDao, classes.Organizador, java.util.*"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="./css/tabela.css">
        <link href="css/grafico.css" rel="stylesheet" type="text/css"/>
        <link href="css/menu.css" rel="stylesheet" type="text/css"/>
        <link href="css/padrao.css" rel="stylesheet" type="text/css"/>
        <script src="./scripts/filtrar.js"></script>
         <script src="./scripts/pdf.js"></script>
        <title>Relatório de Usuários</title>
        
           <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.3.4/jspdf.plugin.autotable.min.js"></script>
        
        
    </head>
    <body>
       
            <%@include file="acessoadm.jsp"%>
        
            <div class="topnav">
                <%@include file="menu.jsp"%>
            </div>
            <div class="content">        
            <%
                
                List<Cliente> list = ClienteDao.getRelatorio();
                request.setAttribute("list", list);
               
                int[] valores = ClienteDao.getRelatorioCliente();
                request.setAttribute("valores", valores);
                
               
            %>
            
            <%
                
                List<Organizador> list2 = OrganizadorDao.getRelatorio();
                request.setAttribute("list2", list2);
               
                int[] valores2 = OrganizadorDao.getRelatorioOrganizador();
                request.setAttribute("valores2", valores2);
                
               
            %>
        
            <h1>Relatório de Usuários</h1>
            
            		<input type="text" id="filtrarnomes" onkeyup="filtrar('filtrarnomes', 1)" placeholder="Busca de nomes">
			<input type="text" id="filtraremails" onkeyup="filtrar('filtraremails', 2)" placeholder="Busca de emails">

            <table id="myTable">
            <tr><th>Id</th><th>Nome</th><th>Email</th><th>Acesso</th></tr>
                <c:forEach items="${list}" var="cliente">
                <tr>
                    <td>${cliente.getidCliente()}</td>
                    <td>${cliente.getnome()}</td>
                    <td>${cliente.getemail()}</td>               
                    <td>${cliente.getacesso()}</td> 
                    
          
                </tr>
                </c:forEach>
                <tr><th>Id</th><th>Nome</th><th>Email</th><th>Acesso</th></tr>
                <c:forEach items="${list2}" var="organizador">
                <tr>
                    <td>${organizador.getidOrganizador()}</td>
                    <td>${organizador.getnome()}</td>
                    <td>${organizador.getemail()}</td>               
                    <td>${organizador.getacesso()}</td> 
                    
          
                </tr>
                </c:forEach>
            </table>
         
    </div>
    <div>         
        <!-- PDF III - Botão que aciona a função getPDF() no arquivo pdf.js -->
        <form><input type="button" value="Gerar PDF" onclick="getPDF()"></form>
    </div>    
    <div class="footer">
        <%@include file="rodape.jsp"%>
    </div>
    </body>
</html>