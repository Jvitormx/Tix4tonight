<%@ taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c" %>
<%@ page import="dao.Dao, dao.ClienteDao, classes.Cliente, java.util.*"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="./css/tabela.css">
        <link href="css/grafico.css" rel="stylesheet" type="text/css"/>
        <link href="css/menu.css" rel="stylesheet" type="text/css"/>
        <link href="css/padrao.css" rel="stylesheet" type="text/css"/>
        <title>Lista de Clientes</title>
    </head>
    <body>
            <%@include file="acessoadm.jsp"%>
            
            <div class="topnav">
                <%@include file="menu.jsp"%>
            </div>
            <div class="content">        
            <%
                String pag = request.getParameter("pag");
                int id = Integer.parseInt(pag);
                
                //Quantidade de Registros da Página
                int total = 5;
                
                if(id!=1){
                    id = id -1;
                    id = id * total + 1;
                }
                
                List<Cliente> list = ClienteDao.getCliente(id,total);
                request.setAttribute("list", list);
                
                int contagem = ClienteDao.getContagem();
                int i;
                request.setAttribute("contagem", contagem);
                if(contagem%total==0){
                    contagem=contagem/total;
                }else{
                    contagem=contagem/total + 1;    
                }

            %>
        
            <h1>Lista de Usuários</h1>
            <table>
            <tr><th>Id</th><th>Nome</th><th>Email</th><th>Senha</th><th>Acesso</th><th>Status</th><th colspan="3">Ações</td></tr>
                <c:forEach items="${list}" var="cliente">
                <tr>
                    <td>${cliente.getidCliente()}</td>
                    <td>${cliente.getnome()}</td>
                    <td>${cliente.getemail()}</td>            
                    <td>${cliente.getsenha()}</td>    
                    <td>${cliente.getacesso()}</td> 
                    <td>${cliente.getstatus()}</td>
                    <td><a href="clienteeditarform.jsp?id=${cliente.getidCliente()}"><img src="./imagens/editar.png" alt="Editar Usuário"></a></td>
                    <td><a href="clientebloquear.jsp?id=${cliente.getidCliente()}&status=${cliente.getstatus()}"><img src="./imagens/bloquear.png" alt="Bloquear Usuário"></a></td>
                    <td><a href="clienteexcluir.jsp?id=${cliente.getidCliente()}"><img src="./imagens/excluir.png" alt="Excluir Usuário"></a></td>            
                </tr>
                </c:forEach>
            </table>
                <div class="pagination">
                    <% for(i=1; i <= contagem; i++) {%>
                            <a href="clientescontrolar.jsp?pag=<%=i%>"><%=i%></a>
                    <% } %>   
                </div>  
            <a href="clientecadastrarform.html"><img src="./imagens/incluir.png" alt="Incluir Usuário"></a>
          
    </div>

    <div class="footer">
        <%@include file="rodape.jsp"%>
    </div>
    </body>
</html>
