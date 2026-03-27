<?php
session_start(); // Inicia a sessão para manter o usuário logado
require("conexao.php");

$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$senha = filter_input(INPUT_POST, 'senha');

if ($email && $senha) {
    try {
        // Busca o usuário pelo e-mail
        $sql = $pdo->prepare("SELECT * FROM colaborador WHERE email = :email");
        $sql->bindValue(':email', $email);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $colaborador = $sql->fetch(PDO::FETCH_ASSOC);

            // Verifica se a senha digitada combina com o hash do banco
            if ($senha == $colaborador['senha']) {
                // Login com sucesso! Salva na sessão:
                $_SESSION['colaborador_id'] = $colaborador['id'];
                $_SESSION['colaborador_nome'] = $colaborador['nome'];

                header("Location: index.php"); // Mude para sua página inicial após login
                exit();
            } else {
                echo "Senha incorreta!";
            }
        } else {
            echo "E-mail não encontrado!";
        }
    } catch (PDOException $e) {
        echo "Erro no sistema: " . $e->getMessage();
    }
} else {
    echo "Preencha todos os campos!";
}
?>