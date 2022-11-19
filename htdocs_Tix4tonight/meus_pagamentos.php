<?php
session_start();

//Verifica se o usuário logou.
if(!isset ($_SESSION['nome']) || !isset ($_SESSION['acesso']))
{
  unset($_SESSION['nome']);
  unset($_SESSION['acesso']);
  header('location:index.html');
  exit;
}

//Cria variáveis com a sessão.
$logado = $_SESSION['nome'];

//Faz a conexão com o BD.
require 'conexao.php';

//Lê a página que será exibida
$id = $_GET["pag"];
$idC = $_GET["idCliente"];

//Quantidade de registros a serem exibidos
$total = 10;

//Indica o registro limite para paginação
if($id!=1){
    $id = $id -1;
    $id = $id * $total + 1;
}

$id--;

//Cria o SQL com limites de página ordenado por id
$sql = "SELECT * FROM pedido WHERE Cliente_idCliente = '$idC' ORDER BY ID_pagamento DESC LIMIT $id, $total";

//Conta a quantidade total de registros
$sql1 = "SELECT count(*) as contagem FROM pedido";

//Executa o SQL
$result = $conn->query($sql);
$result1 = $conn->query($sql1);

//Recupera o resultado da contagem
$row1 = $result1->fetch_assoc();
$contagem = $row1["contagem"];

if($contagem%$total==0){
    $contagem=$contagem/$total;
}else{
    $contagem=$contagem/$total + 1;    
}

	//Se a consulta tiver resultados
	 if ($result->num_rows > 0) {
?>
<div class="content">
<head>
    <link rel="stylesheet" href="./css/tabela.css">
<link rel="stylesheet" href="./css/padrao.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<!-- CSS only -->

</head>

	<h1>‎Compras efetuadas</h1>
	<h1>‎</h1>
	
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">ID_Pagamento</th>
      <th scope="col">ID_Ingresso</th>
      <th scope="col">Quantidade</th>
      <th scope="col">Valor</th>
       <th scope="col">Status</th>
        <th scope="col">Data de compra</th>
    </tr>
  </thead>
  <tbody>
    <tr>
        <?php
	  while($row = $result->fetch_assoc()) {
	      if($row["ID_pagamento"]==442){
	          echo "<tr style='background-color:pink'>";
	      }else{
	          echo "<tr>";
	      }
	
	      echo "<tr>";
      echo "<th scope='row'>" . $row["ID_pagamento"] . "</th>";
      echo "<td>" . $row["Ingresso_idIngresso"] . "</td>";
      echo "<td>" . $row["Quantidade"] . "</td>";
      echo "<td>" . $row["Valor"] . "</td>";
        echo "<td>" . $row["Status"] . "</td>";
        echo "<td>" .   $row["CompraData"] . "</td>";
        echo " </tr>";
	  }
	?>
  </tbody>
</table>

</div>

<div class="pagination">
   <nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">Anterior</span>
      </a>
    </li>
 <?php for($i=1; $i <= $contagem; $i++) {
   echo "<li class='page-item'><a class='page-link' href='meus_pagamentos.php?pag=$i'>$i</a></li>";
 } 
?>   
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
        <span class="sr-only">Próximo</span>
      </a>
    </li>
  </ul>
</nav>
</div>  
            
    </div>

</body>
</html>
<?php
	//Se a consulta não tiver resultados  			
	} else {
		echo "<h1>Nenhum resultado foi encontrado.</h1>";
	}
	
//Fecha a conexão.	
	$conn->close();
?> 