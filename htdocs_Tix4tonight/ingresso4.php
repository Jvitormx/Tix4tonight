<?php
session_start();
//Verifica se o usuário logou.
if(!isset ($_SESSION['title']))
{
  unset($_SESSION['title']);
  header('location:tela_criar_evento.php');
  exit;
}

//Cria variáveis com a sessão.
$titulo = $_SESSION['title'];

// Dados do evento
$campotipo = $_POST["TipodeIngresso_idTipodeIngresso"];
$campoquant = $_POST["quantidadeTotal"];
$campolit = $_POST["dataLimite"];
$campoprom = $_POST["promocao"];

//Faz a conexão com o BD.
include_once ("conexao.php");

$results = mysqli_query($conn,"SELECT * FROM ingresso WHERE TipodeIngresso_idTipodeIngresso = $campotipo");
            $row = mysqli_fetch_array($results,MYSQLI_ASSOC);

$idingresso = $row['idIngresso'];
$y = $row['quantidadeTotal'];  

echo "Difference: ",$y; 
echo "Difference: ",$campoquant; 

$z = $y - $campoquant;  
echo "Difference: ",$z;  
echo "Difference: ",$idingresso;  

$sql2 = "UPDATE `ingresso` SET `quantidadeTotal` = '$z' WHERE `ingresso`.`quantidadeTotal` = '$y' AND `ingresso`.`idIngresso` = $idingresso;
";

//Executa o SQL e faz tratamento de erros
if ($conn->query($sql2) === TRUE) {
//  header( "refresh:5;url=principal.php.html" );
  echo "Evento criado2!!!";

} else {
  //header( "refresh:5;url=Tela_erro_2.html" );	
  echo "Error: " . $sql . "<br>" . $conn->error;
}

//Insere na tabela os valores dos campos
$sql = "INSERT INTO ingresso (TipodeIngresso_idTipodeIngresso, preco, quantidadeTotal, dataLimite, statusIng, Evento_idEvento, selecao, promocao) VALUES ('$campotipo', NULL, '$campoquant', '$campolit', '1', (SELECT id from evento WHERE title='$titulo'), 'aguardando', '$campoprom')";

//Executa o SQL e faz tratamento de erros
if ($conn->query($sql) === TRUE) {
//  header( "refresh:5;url=principal.php.html" );
  echo "Evento criado!!!";

} else {
  //header( "refresh:5;url=Tela_erro_2.html" );	
  echo "Error: " . $sql . "<br>" . $conn->error;
}

//Fecha a conexão.
$conn->close();


?>