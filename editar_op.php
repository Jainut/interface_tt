<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require("conexao.php");

$erro = $_GET['erro'] ?? null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $codigo_ordem = $_POST['codigo_ordem'] ?? null;
    $produto   = $_POST['produto'] ?? null;
    $quantidade   = $_POST['quantidade'] ?? null;
    $data_inicio  = $_POST['data_inicio'] ?? null;
    $data_fim     = $_POST['data_fim'] ?? null;
    $status_o     = $_POST['status_o'] ?? null;

    if ($codigo_ordem && $produto && $quantidade && $data_inicio && $data_fim && $status_o) {
        try {
            // CORREÇÃO: Tabela sem acento (ordemproducao) e Coluna corrigida (Produto)
            $sql = "UPDATE ordemproducao 
                    SET Produto = :produto, 
                        Quantidade = :qtd, 
                        DataInicio = :inicio, 
                        DataFim = :fim, 
                        StatusO = :status 
                    WHERE CodigoDeOrdem = :codigo";
            
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':produto', $produto);
            $stmt->bindValue(':qtd', $quantidade, PDO::PARAM_INT);
            $stmt->bindValue(':inicio', $data_inicio);
            $stmt->bindValue(':fim', $data_fim);
            $stmt->bindValue(':status', $status_o);
            $stmt->bindValue(':codigo', $codigo_ordem); 

            $stmt->execute();

            // Volta para a listagem com sucesso
            header("Location: ordemprodução.php?sucesso_editar=1");
            exit;

        } catch (PDOException $e) {
            header("Location: editar_op.php?id=" . urlencode($codigo_ordem) . "&erro=banco");
            exit;
        }
    }
    header("Location: editar_op.php?id=" . urlencode($codigo_ordem) . "&erro=campos_vazios");
    exit;
}

$id = $_GET['id'] ?? null;

// Se não tem ID na URL, chuta o usuário de volta pra lista
if (!$id) {
    header("Location: ordemprodução.php");
    exit;
}

// Busca a OP específica no banco
$stmt = $pdo->prepare("SELECT * FROM ordemproducao WHERE CodigoDeOrdem = :id");
$stmt->bindValue(':id', $id);
$stmt->execute();
$op = $stmt->fetch(PDO::FETCH_ASSOC);

// Se a OP não existir (alguém digitou ID errado na URL)
if (!$op) {
    header("Location: ordemprodução.php?erro=nao_encontrado");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Ordem de Produção</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar bg-primary text-white p-3 shadow-sm mb-4">
        <span class="fs-4 ms-3">Editar Ordem de Produção</span>
    </nav>

    <a href="ordemprodução.php" class="btn btn-secondary position-absolute top-3 start-3 m-3">
        Voltar
    </a>

    <div class="card p-4 shadow mx-auto" style="max-width: 900px; margin-top: 60px;">
        <h5 class="text-center mb-4">Editando OP: <?= htmlspecialchars($op['CodigoDeOrdem']) ?></h5>

        <?php if ($erro == 'campos_vazios'): ?>
            <div class="alert alert-warning">Todos os campos são obrigatórios.</div>
        <?php endif; ?>

        <?php if ($erro == 'banco'): ?>
            <div class="alert alert-danger">Erro ao atualizar a OP no banco de dados. Verifique os valores.</div>
        <?php endif; ?>

        <form action="editar_op.php" method="post">
            <div class="row mb-3">
                <div class="col-md-2">
                    <label class="form-label">Código da OP</label>
                    <input type="text" class="form-control bg-light" name="codigo_ordem"
                        value="<?= htmlspecialchars($op['CodigoDeOrdem']) ?>" readonly required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Produto</label>
                    <input class="form-control" name="produto"
                        value="<?= htmlspecialchars($op['Produto']) ?>" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label">Quantidade</label>
                    <input type="number" class="form-control" name="quantidade"
                        value="<?= htmlspecialchars($op['Quantidade']) ?>" min="1" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Data de Início</label>
                    <input type="date" class="form-control" name="data_inicio"
                        value="<?= htmlspecialchars($op['DataInicio'] ?? '') ?>" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Data Prevista (Fim)</label>
                    <input type="date" class="form-control" name="data_fim"
                        value="<?= htmlspecialchars($op['DataFim'] ?? '') ?>" required>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-12">
                    <label class="form-label">Status</label>
                    <select class="form-select" name="status_o" required>
                        <option value="Planejada" <?= $op['StatusO'] == 'Planejada' ? 'selected' : '' ?>>Planejada</option>
                        <option value="Em Andamento" <?= $op['StatusO'] == 'Em Andamento' ? 'selected' : '' ?>>Em Andamento</option>
                        <option value="Suspensa" <?= $op['StatusO'] == 'Suspensa' ? 'selected' : '' ?>>Suspensa</option>
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100">
                Salvar Alterações
            </button>
        </form>
    </div>

</body>
</html>