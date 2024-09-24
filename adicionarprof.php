<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $stmt = $pdo->prepare("INSERT INTO professor (nome) VALUES (:nome)");
    $stmt->execute(['nome' => $nome]);
    header("Location: index.php");
}
?>
