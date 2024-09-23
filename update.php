<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $professorId = $_POST['professorId'];
    $diarioId = $_POST['diarioId'];
    $professorNome = $_POST['professorNome'];
    $horaAula = $_POST['horaAula'];
    $sala = $_POST['sala'];

    // Atualizar professor
    $stmt = $conn->prepare("UPDATE professor SET nome = ? WHERE id = ?");
    $stmt->bind_param("si", $professorNome, $professorId);
    $stmt->execute();

    // Atualizar diário
    $stmt = $conn->prepare("UPDATE diario SET hora_aula = ? WHERE id = ?");
    $stmt->bind_param("si", $horaAula, $diarioId);
    $stmt->execute();

    // Atualizar aula
    $stmt = $conn->prepare("UPDATE aulas SET sala = ? WHERE diario_id = ?");
    $stmt->bind_param("si", $sala, $diarioId);
    $stmt->execute();

    echo "Registro atualizado com sucesso!";
} else {
    $diarioId = $_GET['id'];

    $stmt = $conn->prepare("SELECT p.nome, d.hora_aula, a.sala 
                            FROM diario d 
                            JOIN professor p ON d.professor_id = p.id 
                            LEFT JOIN aulas a ON d.id = a.diario_id 
                            WHERE d.id = ?");
    $stmt->bind_param("i", $diarioId);
    $stmt->execute();
    $result = $stmt->get_result();
    $diario = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Atualizar Registro</title>
</head>
<body>
    <h1>Atualizar Registro</h1>
    <form method="post">
        <input type="hidden" name="diarioId" value="<?php echo $diarioId; ?>">
        <input type="hidden" name="professorId" value="<?php echo $diario['professor_id']; ?>">
        Nome do Professor: <input type="text" name="professorNome" value="<?php echo $diario['nome']; ?>" required>
        Hora da Aula: <input type="time" name="horaAula" value="<?php echo $diario['hora_aula']; ?>" required>
        Sala: <input type="text" name="sala" value="<?php echo $diario['sala']; ?>" required>
        <button type="submit">Atualizar</button>
    </form>
</body>
</html>
