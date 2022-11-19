<?php
session_start();

//Faz a leitura do dado passado pelo link.
$campoid = 99;

//Faz a conexão com o BD.
require_once 'conexao.php'; 


$clienteId = $_SESSION['id'];

 //Cria o SQL (consulte tudo da tabela usuarios)
$sql = "SELECT * FROM cliente WHERE idCliente = '$clienteId'";

//Executa o SQL
$result = $conn->query($sql);

	//Se a consulta tiver resultados
	 if ($result->num_rows > 0) {

// Cria uma matriz com o resultado da consulta
 $row = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="pt">
<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="css/.css"/>
    <title>Comment System Ajax | Brave Coder</title>
    	<script src="jquery-3.1.1.min.js"></script>
<script src="indexcomment.js"></script>
</head>
<body>
    
    
    <div class="wrapper">

        <?php
        echo '<form method="post" action="inserecomment.php">';
            echo '<div class="inputBox">';
                echo' <br>';
                
               echo '<input type="hidden" name="nome" value= ' . $row["nome"] . '>';
                  
                 echo '<input type="hidden" name="idCliente" value= ' . $clienteId . '>';
                    
                  echo '<input type="hidden" name="idEvento" value= ' . $campoid . '>';
            echo '</div>';
            echo '<div class="inputBox">';
                echo '<label for="comentario">Message:</label>';
               echo  '<br>'; 
                echo '<textarea name="comentario" placeholder="Comente qualquer coisa ;)" required></textarea>';
            echo '</div>';
         echo '<button type="submit">confirmar</button>';
        echo '</form>';
        echo '<hr>';
        echo '<div class="content" id="content">';
            
        echo '</div>';
        
        
        ?>
    </div>
    <?php
	//Se a consulta não tiver resultados  			
	} else {
		echo "<h1>Nenhum resultado foi encontrado.</h1>";
	}

	//Fecha a conexão.	
	$conn->close();
	


?> 
</body>
</html>