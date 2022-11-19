<?php
    include 'conexao.php';

    $nome = $_POST['nome'];
    $comentario = $_POST['comentario'];
    $clienteid = $_POST['idCliente'];
    $eventoid = $_POST['idEvento'];
    
    echo $nome;
        echo $comentario;
        echo $clienteid;
        echo $eventoid;
        
    $sql = "INSERT INTO comentario (nome, comentario, Cliente_idCliente, Evento_idEvento) VALUES ('$nome', '$comentario', '$clienteid', '$eventoid')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo 1;
    }else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
?>