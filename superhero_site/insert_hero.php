<?php
include('db_config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $alignment = $_POST['alignment'];
    $intelligence = $_POST['intelligence'];
    $strength = $_POST['strength'];
    $speed = $_POST['speed'];
    $image = $_POST['image']; 

    $query = "INSERT INTO heroes (name, alignment, intelligence, strength, speed, image) 
              VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssiiis', $name, $alignment, $intelligence, $strength, $speed, $image);

    if ($stmt->execute()) {
        echo "Herói inserido com sucesso!";
    } else {
        echo "Erro ao inserir herói.";
    }
}
?>

<form method="POST">
    Nome: <input type="text" name="name" required><br>
    Alinhamento: <input type="text" name="alignment" required><br>
    Inteligência: <input type="number" name="intelligence" required><br>
    Força: <input type="number" name="strength" required><br>
    Velocidade: <input type="number" name="speed" required><br>
    Imagem (URL): <input type="text" name="image" required><br>
    <button type="submit">Inserir Herói</button>
</form>
