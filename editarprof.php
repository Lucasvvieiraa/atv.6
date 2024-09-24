<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $stmt = $pdo->prepare("UPDATE professor SET nome = :nome WHERE id = :id");
    $stmt->execute(['nome' => $nome, 'id' => $id]);
    header("Location: index.php");
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM professor WHERE id = :id");
$stmt->execute(['id' => $id]);
$professor = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Professor</title>
</head>
<body>
    <h1>Editar Professor</h1>
    <form action="editarprof.php" method="POST">
        <input type="hidden" name="id" value="<?= $professor['id'] ?>">
        <input type="text" name="nome" value="<?= $professor['nome'] ?>" required>
        <button type="submit">Atualizar</button>
    </form>
</body>
</html>
