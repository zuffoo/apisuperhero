<?php
include('db_connection.php');

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $hero_id = $_GET['id'];
    
    
    $query = "DELETE FROM heroes WHERE id = $hero_id";
    
    if (mysqli_query($conn, $query)) {
        echo "Herói excluído com sucesso.";
    } else {
        echo "Erro ao excluir herói: " . mysqli_error($conn);
    }
} else {
    echo "ID de herói inválido.";
}

mysqli_close($conn);
?>
