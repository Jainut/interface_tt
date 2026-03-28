<?php
require("conexao.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $nome = $_POST['nome'] ?? null;
    $email = $_POST['email'] ?? null;
    $cargo = $_POST['cargo'] ?? null;
    $senha = $_POST['senha'] ?? null;
    $ativo = 1;

    if ($nome && $email && $cargo && $senha) {
        try {
            $sql = "CALL CadastrarColaborador(:nome, :email, :cargo, :senha, :ativo)";
            $stmt = $pdo->prepare($sql);

            $stmt->bindValue(':nome', $nome);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':cargo', $cargo);
            $stmt->bindValue(':senha', $senha);
            $stmt->bindValue(':ativo', $ativo);

            $stmt->execute();

            header("Location: cadastro.php?sucesso=1");
            exit;

        } catch (PDOException $e) {
            if ($e->getCode() == '45000') {
                header("Location: cadastro.php?erro=email_duplicado&nome=" . urlencode($nome) . "&email=" . urlencode($email) . "&cargo=" . urlencode($cargo));
                exit;
            }

            header("Location: cadastro.php?erro=banco");
            exit;
        }
    }

    header("Location: cadastro.php?erro=campos_vazios");
    exit;
}
?>