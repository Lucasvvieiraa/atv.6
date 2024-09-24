<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $sala = $_POST['sala'];
    $hora_aula = $_POST['hora_aula'];
    $professor_id = $_POST['professor_id'];

    // Atualiza o diário
    $stmt = $pdo->prepare("UPDATE diario SET hora_aula = :hora_aula, professor_id = :professor_id WHERE id = (SELECT diario_id FROM aulas WHERE id = :id)");
    $stmt->execute(['hora_aula' => $hora_aula, 'professor_id' => $professor_id, 'id' => $id]);

    // Atualiza a aula
    $stmt = $pdo->prepare("UPDATE aulas SET sala = :sala WHERE id = :id");
    $stmt->execute(['sala' => $sala, 'id' => $id]);

    header("Location: index.php");
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT aulas.id, aulas.sala, diario.hora_aula, diario.professor_id FROM aulas
                       JOIN diario ON aulas.diario_id = diario.id WHERE aulas.id = :id");
$stmt->execute(['id' => $id]);
$aula = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Aula</title>
</head>
<body>
    <h1>Editar Aula</h1>
    <form action="editaraula.php" method="POST">
        <input type="hidden" name="id" value="<?= $aula['id'] ?>">
        <input type="text" name="sala" value="<?= $aula['sala'] ?>" required>
        <input type="time" name="hora_aula" value="<?= $aula['hora_aula'] ?>" required>
        <select name="professor_id" required>
            <option value="">Selecione o Professor</option>
            <?php
            $stmt = $pdo->query("SELECT * FROM professor");
            while ($row = $stmt->fetch()) {
                $selected = ($row['id'] == $aula['professor_id']) ? 'selected' : '';
                echo "<option value='{$row['id']}' $selected>{$row['nome']}</option>";
            }
            ?>
        </select>
        <button type="submit">Atualizar</button>
    </form>
</body>
</html>
