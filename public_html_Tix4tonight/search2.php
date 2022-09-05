<?php
session_start();
//Verifica se o usuário logou.
if(!isset ($_SESSION['nome']) || !isset ($_SESSION['acesso']))
{
  unset($_SESSION['nome']);
  unset($_SESSION['acesso']);
  header('location:login.html');
  exit;
}

//Cria variáveis com a sessão.
$logado = $_SESSION['nome'];
$acesso = $_SESSION['acesso'];

    if (isset($_POST['submit'])) {
        // Connect to the database
        $connection_string = new mysqli("localhost", "id18872510_tix4", "Y!z3F!R3%QCr4wvb", "id18872510_tix4tonightzz");
        
        // Escape the search string and trim
        // all whitespace
        $searchString = mysqli_real_escape_string($connection_string, trim(htmlentities($_POST['search'])));
         $searchString2 = mysqli_real_escape_string($connection_string, trim(htmlentities($_POST['search'])));

        // If there is a connection error, notify
        // the user, and Kill the script.
        if ($connection_string->connect_error) {
            echo "Failed to connect to Database";
            exit();
        }

        // Check for empty strings and non-alphanumeric
        // characters.
        // Also, check if the string length is less than
        // three. If any of the checks returns "true",
        // return "Invalid search string", and
        // kill the script

        // We are using a prepared statement with the
        // search functionality to prevent SQL injection.
        // So, we need to prepend and append the search
        // string with percent signs
        $searchString = "%$searchString%";
          $searchString2 = "%$searchString2%";

        // The prepared statement
        $sql = "SELECT title FROM evento WHERE title LIKE ? OR bairro LIKE ?"; 
        // Prepare, bind, and execute the query
        $prepared_stmt = $connection_string->prepare($sql);
        $prepared_stmt->bind_param('ss', $searchString, $searchString2);
        $prepared_stmt->execute();

        // Fetch the result
        $result = $prepared_stmt->get_result();
		
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
   <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet"> 
<link rel="stylesheet" href="css/menu4.css"/>

    <link rel="icon" type="image/x-icon" href="/imagens/favicon.ico"> 

      <title>Tix4tonight</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="https://cdnjs.cl
   </head>
   <body>
      
	  

	  
	  <?php

	  if ($result->num_rows > 0) {
		  while ($row = mysqli_fetch_object($result))
        {
			
			echo '<div class="container1">';
                echo '<div class="card1">';
				 echo '<div class="card-header1">';
				 echo '<img src="data:image/jpeg;base64,'.base64_encode($row->img) .'" />';
				 echo '</div>';
				 echo '<div class="card-body1">';
				 echo  '<span class="tag tag-teal">' . ($row->Categoria_idCategoria) . '</span>';
                 echo '<h4>' . ($row->title) . '</h4>';
				  echo '<p>' . date('d/m - H:i', strtotime($row->start)) . '</p>';
				  echo '<p>' . ($row->cidade) . '</p>';
				  echo '</div>';
				  echo '</div>';
		}
				  

        } else {
        exit();
    }
	  }
	  
	?>
