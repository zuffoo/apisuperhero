<?php
include('db_config.php');

$query = "DELETE FROM log";
$stmt = $conn->prepare($query);

if ($stmt->execute()) {
    echo 'Todos os logs foram excluídos com sucesso!';
} else {
    echo 'Erro ao excluir logs.';
}
?>
