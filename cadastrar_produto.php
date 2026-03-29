<?php
require("conexao.php");

$sucesso = false;
$erro_msg = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'] ?? null;
    $data_saida = $_POST['data_saida'] ?? null;

    if ($nome && $data_saida) {
        try {
            // Chama a procedure: CadastrarProduto(Nome, DataSaida)
            $stmt = $pdo->prepare("CALL CadastrarProduto(?, ?)");
            $stmt->execute([$nome, $data_saida]);

            $sucesso = true;
        } catch (PDOException $e) {
            $erro_msg = "Erro interno no banco de dados: " . $e->getMessage();
        }
    } else {
        $erro_msg = "Preencha todos os campos.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Produto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="index.js" defer></script>
</head>

<body class="d-flex justify-content-center align-items-center vh-100 bg-light">

    <button class="btn btn-primary position-absolute top-0 start-0 m-3" onclick="entrarTela()">
        Voltar
    </button>

    <div class="card p-3 shadow-sm" style="width: 25rem;">
        <div class="card-body">
            <h5 class="card-title text-center mb-4">Novo Produto</h5>

            <?php if ($erro_msg): ?>
                <div class="alert alert-danger">
                    <?= htmlspecialchars($erro_msg) ?>
                </div>
            <?php endif; ?>

            <?php if ($sucesso): ?>
                <div class="alert alert-success">
                    Produto cadastrado com sucesso.
                </div>
            <?php endif; ?>

            <form action="" method="POST">
                <div class="mb-3">
                    <label class="form-label">Nome do Produto:</label>
                    <input type="text" name="nome" class="form-control" required>
                </div>
                
                <div class="mb-4">
                    <label class="form-label">Data de Saída Prevista:</label>
                    <input type="datetime-local" name="data_saida" class="form-control" required>
                </div>
                
                <button type="submit" class="btn btn-success w-100">
                    Salvar Produto
                </button>
            </form>
        </div>
    </div>

</body>
</html>