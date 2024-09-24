<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Professores e Aulas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Rian Dias e Lucas Vieira</h1>
    
    <h2>Adicionar Professor</h2>
    <form action="adicionarprof.php" method="POST">
        <input type="text" name="nome" placeholder="Nome do Professor" required>
        <button type="submit">Adicionar</button>
    </form>

    <h2>Professores Cadastrados</h2>
    <ul>
        <?php
        $stmt = $pdo->query("SELECT * FROM professor");
        while ($row = $stmt->fetch()) {
            echo "<li>{$row['nome']} 
                <a href='editarprof.php?id={$row['id']}'>Editar</a>
                <a href='deletarprof.php?id={$row['id']}'>Deletar</a>
                </li>";
        }
        ?>
    </ul>

    <h2>Adicionar Aula</h2>
    <form action="adicionaraula.php" method="POST">
        <input type="text" name="sala" placeholder="Sala" required>
        <input type="time" name="hora_aula" required>
        <select name="professor_id" required>
            <option value="">Selecione o Professor</option>
            <?php
            $stmt = $pdo->query("SELECT * FROM professor");
            while ($row = $stmt->fetch()) {
                echo "<option value='{$row['id']}'>{$row['nome']}</option>";
            }
            ?>
        </select>
        <button type="submit">Adicionar</button>
    </form>

    <h2>Aulas Cadastradas</h2>
    <ul>
        <?php
        $stmt = $pdo->query("SELECT aulas.id, aulas.sala, diario.hora_aula, professor.nome AS professor_nome FROM aulas
                              JOIN diario ON aulas.diario_id = diario.id
                              JOIN professor ON diario.professor_id = professor.id");
        while ($row = $stmt->fetch()) {
            echo "<li>{$row['sala']} - {$row['hora_aula']} (Professor: {$row['professor_nome']}) 
                <a href='editaraula.php?id={$row['id']}'>Editar</a>
                <a href='deletaraula.php?id={$row['id']}'>Deletar</a>
                </li>";
        }
        ?>
    </ul>
</body>
</html>
