<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sala = $_POST['sala'];
    $hora_aula = $_POST['hora_aula'];
    $professor_id = $_POST['professor_id'];
    
    $stmt = $pdo->prepare("INSERT INTO diario (hora_aula, professor_id) VALUES (:hora_aula, :professor_id)");
    $stmt->execute(['hora_aula' => $hora_aula, 'professor_id' => $professor_id]);
    
    $diario_id = $pdo->lastInsertId();
    
    $stmt = $pdo->prepare("INSERT INTO aulas (sala, diario_id) VALUES (:sala, :diario_id)");
    $stmt->execute(['sala' => $sala, 'diario_id' => $diario_id]);
    
    header("Location: index.php");
}
?>
