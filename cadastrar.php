<?php
require("conexao.php");

$nome  = filter_input(INPUT_POST, 'nome');
$email = filter_input(INPUT_POST, 'email');
$senha = filter_input(INPUT_POST, 'senha');

try {
    $sql = "INSERT INTO `usuarios` (nome, email, senha) VALUES ('$nome', '$email', '$senha')";
    $pdo->query($sql);

    echo "Cadastrado com sucesso!";
    header("Location: login.htm");
    exit();
} catch (PDOException $e) {
    echo "Erro! Não foi possível registrar: " . $e->getMessage();
}
?>
