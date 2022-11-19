<?php
// Update the details below with your MySQL details
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'id18872510_tix4';
$DATABASE_PASS = 'Y!z3F!R3%QCr4wvb';
$DATABASE_NAME = 'id18872510_tix4tonightzz';
try {
    $pdo = new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
} catch (PDOException $exception) {
    // If there is an error with the connection, stop the script and display the error
    exit('Failed to connect to database!');
}
// Below function will convert datetime to time elapsed string
function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);
    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;
    $string = array('y' => 'ano', 'm' => 'mês', 'w' => 'semana', 'd' => 'dia', 'h' => 'hora', 'i' => 'minuto', 's' => 'segundo');
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }
    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' atrás' : 'agora';
}
// This function will populate the comments and comments replies using a loop
function show_comments($comments, $parent_id = -1) {
    $html = '';
    if ($parent_id != -1) {
        // If the comments are replies sort them by the "submit_date" column
        array_multisort(array_column($comments, 'submit_date'), SORT_ASC, $comments);
    }
    // Iterate the comments using the foreach loop
    foreach ($comments as $comment) {
        if ($comment['parent_id'] == $parent_id) {
            // Add the comment to the $html variable
            $html .= '
            <div class="comment">
                <div>
                    <h3 class="name">' . htmlspecialchars($comment['nome'], ENT_QUOTES) . '</h3>
                    <span class="date">' . time_elapsed_string($comment['submit_date']) . '</span>
                </div>
                <p class="content">' . nl2br(htmlspecialchars($comment['comentario'], ENT_QUOTES)) . '</p>
                <a class="reply_comment_btn" href="#" data-comment-id="' . $comment['idComentario'] . '">Reply</a>
                ' . show_write_comment_form($comment['idComentario']) . '
                <div class="replies">
                ' . show_comments($comments, $comment['idComentario']) . '
                </div>
            </div>
            ';
        }
    }
    return $html;
}
// This function is the template for the write comment form
function show_write_comment_form($parent_id = -1) {
    $html = '
    <div class="write_comment" data-comment-id="' . $parent_id . '">
        <form>
            <input name="parent_id" type="hidden" value="' . $parent_id . '">
            <input name="nome" type="text" placeholder="Seu nome" required>
            <textarea name="comentario" placeholder="Faça um comentário..." required></textarea>
            <button type="submit">Submit Comment</button>
        </form>
    </div>
    ';
    return $html;
}
// Page ID needs to exist, this is used to determine which comments are for which page
if (isset($_GET['id'])) {
    // Check if the submitted form variables exist
    if (isset($_POST['nome'], $_POST['comentario'])) {
        // POST variables exist, insert a new comment into the MySQL comments table (user submitted form)
        $stmt = $pdo->prepare('INSERT INTO comentario (Evento_idEvento, parent_id, nome, comentario, comentario_data, Cliente_idCliente) VALUES (?,?,?,?,NOW()), 10');
        $stmt->execute([ $_GET['Evento_idEvento'], $_POST['parent_id'], $_POST['nome'], $_POST['comentario'] ]);
        exit('Your comment has been submitted!');
    }
    // Get all comments by the Page ID ordered by the submit date
    $stmt = $pdo->prepare('SELECT * FROM comentario WHERE Evento_idEvento = ? ORDER BY comentario_data DESC');
    $stmt->execute([ $_GET['Evento_idEvento'] ]);
    $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Get the total number of comments
    $stmt = $pdo->prepare('SELECT COUNT(*) AS total_comments FROM comentario WHERE Evento_idEvento = ?');
    $stmt->execute([ $_GET['Evento_idEvento'] ]);
    $comments_info = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    exit('No page ID specified!');
}
?>
<div class="comment_header">
    <span class="total"><?=$comments_info['total_comments']?> Comentários</span>
    <a href="#" class="write_comment_btn" data-comment-id="-1">Escrever comentário</a>
</div>

<?=show_write_comment_form()?>

<?=show_comments($comments)?>