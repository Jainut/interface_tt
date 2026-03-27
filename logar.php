<?php
session_start(); // Inicia a sessão para manter o usuário logado
require("conexao.php");

$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$senha = filter_input(INPUT_POST, 'senha');

if ($email && $senha) {
    try {
        // Busca o usuário pelo e-mail
        $sql = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
        $sql->bindValue(':email', $email);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $usuario = $sql->fetch(PDO::FETCH_ASSOC);

            // Verifica se a senha digitada combina com o hash do banco
            if (password_verify($senha, $usuario['senha'])) {
                // Login com sucesso! Salva na sessão:
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_nome'] = $usuario['nome'];

                header("Location: telaTop.htm"); // Mude para sua página inicial após login
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