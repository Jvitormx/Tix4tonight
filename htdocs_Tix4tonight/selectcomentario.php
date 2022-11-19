<?php
    include 'conexao.php';

$campoid=99;
    $sql = "SELECT * FROM comentario WHERE Evento_idEvento = $campoid ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
?>



<div class="comments-container">
		<h1>Comentarios</h1>

		<ul id="comments-list" class="comments-list">
      
			<li>
				<div class="comment-main-level">
					<!-- Avatar -->
					
					<!-- Contenedor del Comentario -->
				<?php
					echo '<div class="comment-box">';
						echo '<div class="comment-head">';
						echo 	'h6 class="comment-name by-author"><a href="http://creaticode.com/blog">' . $row['nome'] . '</a></h6>';
						echo 	'<span' . $row['comentario_data
'] . '</span>';
					echo	'</div>';
					echo	'<div class="comment-content">';
						echo $row['comentario'];
						echo'</div>';
				echo	'</div>';
					?>
				</div>
				</li>
			
		</ul>
	</div>

    <?php } } ?>