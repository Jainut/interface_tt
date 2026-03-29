<?php
session_start(); // Inicia a sessão para manter o usuário logado
require("conexao.php");

$erro_msg = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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

                // Verifica se a senha digitada combina com a do banco
                if ($senha == $colaborador['senha']) {
                    // Login com sucesso! Salva na sessão:
                    $_SESSION['colaborador_id'] = $colaborador['IdColaborador']; // Corrigido para IdColaborador baseado no seu banco
                    $_SESSION['colaborador_nome'] = $colaborador['Nome'];

                    header("Location: index.php"); // Mude para sua página inicial após login
                    exit();
                } else {
                    $erro_msg = "Senha incorreta!";
                }
            } else {
                $erro_msg = "E-mail não encontrado!";
            }
        } catch (PDOException $e) {
            $erro_msg = "Erro no sistema: " . $e->getMessage();
        }
    } else {
        $erro_msg = "Preencha todos os campos!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="index.js" defer></script>
</head>

<body class="d-flex justify-content-center align-items-center vh-100 bg-light">

    <div class="card p-3 shadow-sm" style="width: 22rem;">
        <div class="card-body">
            <h5 class="card-title text-center mb-4">Acesso ao Sistema</h5>

            <?php if ($erro_msg): ?>
                <div class="alert alert-danger text-center">
                    <?= htmlspecialchars($erro_msg) ?>
                </div>
            <?php endif; ?>

            <form action="" method="POST">
                <div class="mb-3">
                    <label class="form-label">Email:</label>
                    <input 
                        type="email" 
                        class="form-control" 
                        name="email" 
                        value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" 
                        required>
                </div>

                <div class="mb-4">
                    <label class="form-label">Senha:</label>
                    <input 
                        type="password" 
                        class="form-control" 
                        name="senha" 
                        required>
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    Entrar
                </button>
            </form>
            
            <div class="text-center mt-3">
                <a href="cadastro.php" class="text-decoration-none">Ainda não tem conta? Cadastre-se</a>
            </div>
        </div>
    </div>

</body>
</html>