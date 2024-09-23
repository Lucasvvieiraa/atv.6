<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $diarioId = $_POST['diarioId'];


    $stmt = $conn->prepare("DELETE FROM aulas WHERE diario_id = ?");
    $stmt->bind_param("i", $diarioId);
    $stmt->execute();


    $stmt = $conn->prepare("DELETE FROM diario WHERE id = ?");
    $stmt->bind_param("i", $diarioId);
    $stmt->execute();

    echo "Registro deletado com sucesso!";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Deletar Registro</title>
</head>
<body>
    <h1>Registro deletado com sucesso!</h1>
    <a href="read.php">Voltar para a lista</a>
</body>
</html>
