<?php
include 'db.php';

function getDados($conn) {
    $sql = "SELECT p.id AS professor_id, p.nome, d.id AS diario_id, d.hora_aula, a.id AS aula_id, a.sala 
            FROM professor p 
            JOIN diario d ON p.id = d.professor_id 
            LEFT JOIN aulas a ON d.id = a.diario_id";
    return $conn->query($sql)->fetch_all(MYSQLI_ASSOC);
}

$dados = getDados($conn);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Listar Registros</title>
</head>
<body>
    <h1>Listar Dados</h1>
    <table border="1">
        <tr>
            <th>Professor</th>
            <th>Hora da Aula</th>
            <th>Sala</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($dados as $dado): ?>
        <tr>
            <td><?php echo $dado['nome']; ?></td>
            <td><?php echo $dado['hora_aula']; ?></td>
            <td><?php echo $dado['sala']; ?></td>
            <td>
                <form method="post" action="update.php" style="display:inline;">
                    <input type="hidden" name="diarioId" value="<?php echo $dado['diario_id']; ?>">
                    <input type="hidden" name="professorId" value="<?php echo $dado['professor_id']; ?>">
                    <button type="submit">Atualizar</button>
                </form>
                <form method="post" action="delete.php" style="display:inline;">
                    <input type="hidden" name="diarioId" value="<?php echo $dado['diario_id']; ?>">
                    <button type="submit">Deletar</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
