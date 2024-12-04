<?php
include 'superhero_db.php'; 

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    parse_str(file_get_contents('php://input'), $data); 
    if (isset($data['log_id'])) {
        $logId = intval($data['log_id']);

        $stmt = $conn->prepare("DELETE FROM log WHERE id = ?");
        $stmt->bind_param("i", $logId);

        if ($stmt->execute()) {
            echo json_encode(["success" => true, "message" => "Log excluído com sucesso!"]);
        } else {
            echo json_encode(["success" => false, "message" => "Erro ao excluir log: " . $conn->error]);
        }
     
    }
}