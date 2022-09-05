<?php
session_start();

//Verifica se o usuário logou.
if(!isset ($_SESSION['nome']) || !isset ($_SESSION['cnpj']))
{
  unset($_SESSION['nome']);
  unset($_SESSION['cnpj']);
  header('location:index.html');
  exit;
}

//Cria variáveis com a sessão.
$logado = $_SESSION['nome'];

//Faz a conexão com o BD.
require 'conexao.php';

//Lê a página que será exibida
$id = $_GET["pag"];
$idOrg = $_GET["idOrganizador"];

//Quantidade de registros a serem exibidos
$total = 5;

//Indica o registro limite para paginação
if($id!=1){
    $id = $id -1;
    $id = $id * $total + 1;
}

$id--;

//Cria o SQL com limites de página ordenado por id
$sql = "SELECT * FROM ingresso WHERE Organizador_idOrganizador = '$idOrg' LIMIT $id, $total";

//Conta a quantidade total de registros
$sql1 = "SELECT count(*) as contagem FROM ingresso";

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
</head>


			<h1>Meus ingressos</h1>
			<table>
<tr><th>ID_Ingresso</th><th>Preço</th><th>Quantidade</th><th>Acesso</th><th>Evento</th><th>Data Limite</th><th colspan="3">Ações</td></tr>
				
	<?php
	  while($row = $result->fetch_assoc()) {
	      if($row["status"]=="inativo"){
	          echo "<tr style='background-color:pink'>";
	      }else{
	          echo "<tr>";
	      }
	      
	      
		echo "<td>" . $row["idIngresso"] . "</td><td>" . $row["preco"] . "</td><td>" . $row["quantidadeTotal"] . "</td><td>" . $row["Evento_idEvento"] . "</td><td>" . $row["dataLimite"] . "</td>";
		#<td><a href='eventobloquear.php?id=" . $row["id"] . "&status=" . $row["status"] . "'><img src='./imagens/bloquear.png' alt='Bloquear Evento'></a></td><td><a href='usuarioexcluir.php?id=" . $row["Id"] . "'><img src='./imagens/excluir.png' alt='Excluir Usuário'></a></td></tr>";
		 
	  }
	?>
				
			</table>
</div>
<div class="pagination">
    <?php for($i=1; $i <= $contagem; $i++) {
            echo "<a href='meus_ingressos.php?pag=$i&idIngresso=$idOrg'>$i</a>";
    } 
	?>   
</div>  
            
    </div>
<div class="footer">
  <p>Projeto Final</p>
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
	
//Se o usuário não usou o formulário

?> 