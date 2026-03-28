<?php
$erro = $_GET['erro'] ?? null;
$sucesso = $_GET['sucesso'] ?? null;

$nome = $_GET['nome'] ?? '';
$email = $_GET['email'] ?? '';
$cargo = $_GET['cargo'] ?? '';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="index.js"></script>
</head>

<body class="d-flex justify-content-center align-items-center vh-100 bg-light">

    <button class="btn btn-primary position-absolute top-0 start-0 m-3" onclick="voltarLogin()">
        Voltar
    </button>

    <div class="card p-3 shadow-sm" style="width: 22rem;">
        <div class="card-body">
            <h5 class="card-title text-center mb-4">Cadastro de Colaborador</h5>

            <?php if ($erro == 'email_duplicado'): ?>
                <div class="alert alert-danger">
                    Este email já está cadastrado no sistema.
                </div>
            <?php endif; ?>

            <?php if ($erro == 'campos_vazios'): ?>
                <div class="alert alert-warning">
                    Preencha todos os campos.
                </div>
            <?php endif; ?>

            <?php if ($erro == 'banco'): ?>
                <div class="alert alert-danger">
                    Erro interno no banco de dados.
                </div>
            <?php endif; ?>

            <?php if ($sucesso): ?>
                <div class="alert alert-success">
                    Colaborador cadastrado com sucesso. Aperte no botão voltar para logar no sistema
                </div>
            <?php endif; ?>

            <form action="cadastrar.php" method="post">
                <div class="mb-3">
                    <label class="form-label">Nome:</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        name="nome" 
                        value="<?= htmlspecialchars($nome) ?>" 
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email:</label>
                    <input 
                        type="email" 
                        class="form-control" 
                        name="email" 
                        value="<?= htmlspecialchars($email) ?>" 
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Cargo:</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        name="cargo" 
                        value="<?= htmlspecialchars($cargo) ?>" 
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
                    Cadastrar Colaborador
                </button>
            </form>
        </div>
    </div>

</body>
</html>