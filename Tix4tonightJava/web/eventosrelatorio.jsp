<%@ taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c" %>
<%@ page import="dao.Dao, dao.EventosDao, classes.Evento, java.util.*"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="./css/tabela.css">
        <link href="css/grafico.css" rel="stylesheet" type="text/css"/>
        <link href="css/menu.css" rel="stylesheet" type="text/css"/>
        <link href="css/padrao.css" rel="stylesheet" type="text/css"/>
        <script src="./scripts/filtrar.js"></script>
        <title>Relatório de Eventos</title>
    </head>
    <body>
        
            <%@include file="acessoadm.jsp"%>
        
            <div class="topnav">
                <%@include file="menu.jsp"%>
            </div>
            <div class="content">        
            <%
                
                List<Evento> list = EventosDao.getRelatorio();
                request.setAttribute("list", list);
               
                int[] valores = EventosDao.getRelatorioEvento();
                request.setAttribute("valores", valores);
                

            %>
        
            <h1>Relatório de Eventos</h1>
            
            		<input type="text" id="filtrarnomes" onkeyup="filtrar('filtrarnomes', 1)" placeholder="Busca de nomes">
			<input type="text" id="filtraremails" onkeyup="filtrar('filtraremails', 2)" placeholder="Busca de emails">

            <table id="myTable">
            <tr><th>Id</th><th>Título</th><th>Id Categoria</th></tr>
                <c:forEach items="${list}" var="evento">
                <tr>
                    <td>${evento.getId()}</td>
                    <td>${evento.getTitle()}</td>              
                    <td>${evento.getCategoria_idCategoria()}</td> 
          
                </tr>
                </c:forEach>
            </table>
 
            <div class="grafico">
                <canvas id="myChart"></canvas>
                <p>Distribuição de Categorias:</p>
                <p>Festival/show: <%=valores[0]%></p>
                <p>Gastronomia: <%=valores[2]%></p>
                <p>Curso/workshop: <%=valores[3]%></p>
                <p>Congresso/palestra: <%=valores[4]%></p>
                <p>Feira/exposição: <%=valores[5]%></p>
                <p>Outro: <%=valores[6]%></p>
                <p>Passeio ou tour: <%=valores[1]%></p>
            </div>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>

    <script type="text/javascript">
        var ctx = document.getElementById("myChart");
        var valores = [<%=valores[0]%>, <%=valores[1]%>, <%=valores[2]%>, <%=valores[3]%>, <%=valores[4]%>, <%=valores[5]%>, <%=valores[6]%>];
        var tipos = ["Festival/show", "Passeio ou tour", "Gastronomia", "Curso/workshop","Congresso/palestra", "Feira/exposição", "Outro"];

        var myChart = new Chart(ctx, {
          type: "pie",
          data: {
            labels: tipos,
            datasets: [
              {
                label: "Evento",
                data: valores,
                backgroundColor: [
                  "rgba(255, 99, 132, 0.2)",
                  "rgba(54, 162, 235, 0.2)",
                  "rgba(255, 206, 86, 0.2)",
                  "rgba(75, 192, 192, 0.2)",
                  "rgba(153, 102, 255, 0.2)",
                  "rgba(245, 40, 145, 0.8)",
                  "rgba(255, 0, 0, 1)",
                ]
              }
            ]
          }
        }); 
    </script>           
    </div>

    <div class="footer">
        <%@include file="rodape.jsp"%>
    </div>
    </body>
</html>

