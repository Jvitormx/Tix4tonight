<?php
//Faz a conexão com o BD.
require 'conexao.php';

//Cria o SQL
$sql = "SELECT id, title, start, end, description, color FROM evento";

//Executa o SQL
$result = $conn->query($sql);

$eventos=[];

//Existem formas mais simples tipo fetchAll,
//mas depende de versão do PHP
while($row = $result->fetch_assoc()) {
	array_push($eventos, $row);
}

//Transforma o array em um padrão json
$eventos = json_encode($eventos);

//O javascript recebe os dados
//Só pode haver um echo
echo $eventos;
?>