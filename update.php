<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $professorId = $_POST['professorId'];
    $diarioId = $_POST['diarioId'];
    $professorNome = $_POST['professorNome'];
    $horaAula = $_POST['horaAula'];
    $sala = $_POST['sala'];
}