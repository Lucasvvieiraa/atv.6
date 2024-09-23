<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $professorNome = $_POST['professorNome'];
    $horaAula = $_POST['horaAula'];
    $sala = $_POST['sala'];

    $sql = "INSERT INTO user (professorNome, horaAula, sala) VALUES ('$professorNome', '$horaAula', '$sala')";

    if ($conn->query($sql) === TRUE) {
        echo "Novo registro criado com sucesso";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}


    $stmt = $conn->prepare("INSERT INTO professor (nome) VALUES (?)");
    $stmt->bind_param("s", $professorNome);
    $stmt->execute();
    $professorId = $conn->insert_id;

    $stmt = $conn->prepare("INSERT INTO diario (hora_aula, professor_id) VALUES (?, ?)");
    $stmt->bind_param("si", $horaAula, $professorId);
    $stmt->execute();
    $diarioId = $conn->insert_id;

    $stmt = $conn->prepare("INSERT INTO aulas (sala, diario_id) VALUES (?, ?)");
    $stmt->bind_param("si", $sala, $diarioId);
    $stmt->execute();

    echo "Registro adicionado com sucesso!";

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Criar Registro</title>
</head>
<body>
    <h1>Adicionar Professor/Diário/Aula</h1>
    <form method="post">
        Nome do Professor: <input type="text" name="professorNome" required>
        Horário da Aula: <input type="time" name="horaAula" required>
        Sala: <input type="text" name="sala" required>
        <button type="submit">Adicionar</button>
    </form>
</body>
</html>
