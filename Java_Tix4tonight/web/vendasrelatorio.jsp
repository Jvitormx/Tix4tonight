<%@ taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c" %>
<%@ page import="dao.Dao, dao.PedidosDao, classes.Pedido, java.util.*"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="./css/tabela1.css">
        <link href="css/grafico.css" rel="stylesheet" type="text/css"/>
        <link href="css/menu.css" rel="stylesheet" type="text/css"/>
        <link href="css/padrao.css" rel="stylesheet" type="text/css"/>
        <script src="./scripts/filtrar.js"></script>
          <script src="./scripts/pdf.js"></script>
        <title>Relatório de Eventos</title>
    </head>
    <body>
        
            <%@include file="acessoadm.jsp"%>
        
            <div class="topnav">
                <%@include file="menu.jsp"%>
            </div>
            <div class="content">        
            <%
                
                List<Pedido> list = PedidosDao.getRelatorio();
                request.setAttribute("list", list);
               
                int[] valores = PedidosDao.getRelatorioPedido();
                request.setAttribute("valores", valores);
                

            %>
        
            <h1>Relatório de Vendas</h1>
            
            		<input type="text" id="filtrarnomes" onkeyup="filtrar('filtrarnomes', 1)" placeholder="Busca de nomes">
			<input type="text" id="filtraremails" onkeyup="filtrar('filtraremails', 2)" placeholder="Busca de emails">

            <table id="myTable">
            <tr><th>Id</th><th>Status</th></tr>
                <c:forEach items="${list}" var="evento">
                <tr>
                    <td>${evento.getId()}</td>
                    <td>${evento.getTitle()}</td>           
          
                </tr>
                </c:forEach>
            </table>
 
            <div class="grafico">
                <canvas id="myChart"></canvas>                
                <p>Total de Pagamentos(Outubro): <%=valores[0]%></p>
                <p>Total de Pagamentos(Novembro): </p>
                <p>Total de Pagamentos(Dezembro): </p>
                <p>Total de Pagamentos(Janeiro): </p>
              <style>
.button-60 {
  align-items: center;
  appearance: none;
  background-color: #fff;
  border: 1px solid #dbdbdb;
  border-radius: .375em;
  box-shadow: none;
  box-sizing: border-box;
  color: #363636;
  cursor: pointer;
  display: inline-flex;
  font-family: BlinkMacSystemFont,-apple-system,"Segoe UI",Roboto,Oxygen,Ubuntu,Cantarell,"Fira Sans","Droid Sans","Helvetica Neue",Helvetica,Arial,sans-serif;
  font-size: 1rem;
  height: 2.5em;
  justify-content: center;
  line-height: 1.5;
  padding: calc(.5em - 1px) 1em;
  position: relative;
  text-align: center;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
  vertical-align: top;
  white-space: nowrap;
}

.button-60:active {
  border-color: #4a4a4a;
  outline: 0;
}

.button-60:focus {
  border-color: #485fc7;
  outline: 0;
}

.button-60:hover {
  border-color: #b5b5b5;
}

.button-60:focus:not(:active) {
  box-shadow: rgba(72, 95, 199, .25) 0 0 0 .125em;
}
</style>
                 <form><input type="button" class="button-60" value="Gerar PDF" onclick="getPDF()"></form>
            </div>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>

    <script type="text/javascript">      
       var ctx = document.getElementById("myChart");
        var valores = [<%=valores[0]%>];
        var tipos = ["Compras"];

        var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ["Outubro", "Novembro", "Dezembro", "Janeiro"],
      datasets: [
        {
          label: "Vendas",
          backgroundColor: "#3e95cd",
          data: [valores,0,0,0]
        }
      ]
    },
    options: {
      title: {
        display: true,
        text: 'Vendas no mês'
      }
    }
});
    </script>           
    </div>

    <div class="footer">
        <%@include file="rodape.jsp"%>
    </div>
    </body>
</html>

