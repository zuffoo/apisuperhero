<?php
include 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['log'])) {
    $numeroregistros = $_POST['numeroregistros'];

    $sql = "INSERT INTO log (numeroregistros) VALUES ('$numeroregistros')";
    if ($conn->query($sql) === TRUE) {
        echo "Log registrado com sucesso!";
    } else {
        echo "Erro ao registrar log: " . $conn->error;
    }
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($_GET['delete_all'])) {
    $sql = "DELETE FROM heroes";
    if ($conn->query($sql) === TRUE) {
        echo "Todos os Heróis excluídos com sucesso!";
    } else {
        echo "Erro ao excluir Herói: " . $conn->error;
    }
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($_GET['delete_all_logs'])) {
    $sql = "DELETE FROM log";
    if ($conn->query($sql) === TRUE) {
        echo "Todos os logs excluídos com sucesso!";
    } else {
        echo "Erro ao excluir logs: " . $conn->error;
    }
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($_GET['delete_log'])) {
    $logId = $_GET['delete_log'];

    $sql = "DELETE FROM log WHERE idlog = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $logId);

    if ($stmt->execute()) {
        echo "Log excluído com sucesso!";
    } else {
        echo "Erro ao excluir log: " . $conn->error;
    }
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['logs'])) {
    $sql = "SELECT * FROM log ORDER BY datahora DESC";
    $result = $conn->query($sql);

    $logs = [];
    while ($row = $result->fetch_assoc()) {
        $logs[] = $row;
    }

    echo json_encode($logs);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['log'])) {
    $hero_id = $_POST['hero_id'];
    $name = $_POST['name'];
    $alignment = $_POST['alignment'];
    $intelligence = $_POST['intelligence'];
    $strength = $_POST['strength'];
    $speed = $_POST['speed'];
    $image = $_POST['image'];

    $checkSql = "SELECT * FROM heroes WHERE hero_id = '$hero_id'";
    $result = $conn->query($checkSql);

    if ($result->num_rows === 0) {
        $sql = "INSERT INTO heroes (hero_id, name, alignment, intelligence, strength, speed, image) 
                VALUES ('$hero_id', '$name', '$alignment', '$intelligence', '$strength', '$speed', '$image')";
        
        if ($conn->query($sql) === TRUE) {
            echo "Herói adicionado com sucesso!";
        } else {
            echo "Erro ao adicionar herói: " . $conn->error;
        }
    } else {
        echo "Herói já existe no banco de dados.";
    }

    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($_GET['delete_hero'])) {
    $id = $_GET['delete_hero'];

    $sql = "DELETE FROM heroes WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "Herói excluído com sucesso!";
    } else {
        echo "Erro ao excluir herói: " . $conn->error;
    }

    exit;
}

$conn->close();
?>
