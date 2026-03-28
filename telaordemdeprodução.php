<?php
$erro = $_GET['erro'] ?? null;
$sucesso = $_GET['sucesso'] ?? null;

$codigo_ordem = $_GET['codigo_ordem'] ?? '';
$id_produto = $_GET['id_produto'] ?? '';
$quantidade = $_GET['quantidade'] ?? '';
$data_inicio = $_GET['data_inicio'] ?? '';
$data_fim = $_GET['data_fim'] ?? '';
$status_o = $_GET['status_o'] ?? 'Planejada';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ordem de Produção</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="index.js"></script>
</head>

<body class="bg-light">

    <nav class="navbar bg-primary text-white p-3 shadow-sm mb-4">
        <span class="fs-4 ms-3">Criar Ordem Produção</span>
    </nav>

    <button class="btn btn-primary position-absolute top-3 start-3 m-3" onclick="entrarTela()">
        Voltar
    </button>

    <div class="card p-4 shadow mx-auto" style="max-width: 900px;">
        <h5 class="text-center mb-4">Abrir Nova Ordem de Produção</h5>

        <?php if ($erro == 'campos_vazios'): ?>
            <div class="alert alert-warning">
                Todos os campos são obrigatórios.
            </div>
        <?php endif; ?>

        <?php if ($erro == 'banco'): ?>
            <div class="alert alert-danger">
                Erro ao cadastrar a OP no banco.
            </div>
        <?php endif; ?>

        <?php if ($sucesso): ?>
            <div class="alert alert-success">
                Ordem de produção cadastrada com sucesso.
            </div>
        <?php endif; ?>

        <form action="cadastrar_op.php" method="post">
            <div class="row mb-3">
                <div class="col-md-2">
                    <label class="form-label">Código da OP</label>
                    <input type="text" class="form-control" name="codigo_ordem"
                        value="<?= htmlspecialchars($codigo_ordem) ?>" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Produto</label>
                    <input class="form-control" name="id_produto"
                        value="<?= htmlspecialchars($id_produto) ?>" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label">Quantidade</label>
                    <input type="number" class="form-control" name="quantidade"
                        value="<?= htmlspecialchars($quantidade) ?>" min="1" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Data de Início</label>
                    <input type="date" class="form-control" name="data_inicio"
                        value="<?= htmlspecialchars($data_inicio) ?>" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Data Prevista (Fim)</label>
                    <input type="date" class="form-control" name="data_fim"
                        value="<?= htmlspecialchars($data_fim) ?>" required>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-12">
                    <label class="form-label">Status Inicial</label>
                    <select class="form-select" name="status_o" required>
                        <option value="Planejada" <?= $status_o == 'Planejada' ? 'selected' : '' ?>>Planejada</option>
                        <option value="Em Andamento" <?= $status_o == 'Em Andamento' ? 'selected' : '' ?>>Em Andamento</option>
                        <option value="Suspensa" <?= $status_o == 'Suspensa' ? 'selected' : '' ?>>Suspensa</option>
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">
                Cadastrar Ordem de Produção
            </button>
        </form>
    </div>

</body>
</html>