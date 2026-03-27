<?php
require("conexao.php");

try {
    // Fazendo um JOIN para buscar o Nome do Produto associado à OP
    $sql = "SELECT op.IdOrdemProducao, op.CodigoDeOrdem, p.Nome AS NomeProduto, op.Quantidade, 
                   op.DataInicio, op.DataFim, op.StatusO 
            FROM OrdemProducao op
            INNER JOIN produto p ON op.IdProduto = p.IdProduto
            ORDER BY op.DataInicio DESC";
            
    $stmt = $pdo->query($sql);
    $ordens = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro ao buscar as ordens de produção: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Ordens de Produção</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4 bg-light">

    <div class="container">
        <h2 class="mb-4">Ordens de Produção (OPs)</h2>
        
        <a href="telaordemdeprodução.htm" class="btn btn-success mb-3">Nova Ordem de Produção</a>

        <div class="table-responsive shadow-sm">
            <table class="table table-striped table-bordered align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Código da OP</th>
                        <th>Produto</th>
                        <th>Qtd.</th>
                        <th>Data Início</th>
                        <th>Data Prevista</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($ordens) > 0): ?>
                        <?php foreach ($ordens as $op): ?>
                            <tr>
                                <td><?= $op['IdOrdemProducao'] ?></td>
                                <td><strong><?= htmlspecialchars($op['CodigoDeOrdem']) ?></strong></td>
                                <td><?= htmlspecialchars($op['NomeProduto']) ?></td>
                                <td><?= $op['Quantidade'] ?></td>
                                <td><?= date('d/m/Y', strtotime($op['DataInicio'])) ?></td>
                                <td><?= date('d/m/Y', strtotime($op['DataFim'])) ?></td>
                                <td>
                                    <?php if($op['StatusO'] == 'Pendente' || $op['StatusO'] == 'Planejada'): ?>
                                        <span class="badge bg-secondary"><?= $op['StatusO'] ?></span>
                                    <?php elseif($op['StatusO'] == 'Em Andamento'): ?>
                                        <span class="badge bg-primary"><?= $op['StatusO'] ?></span>
                                    <?php elseif($op['StatusO'] == 'Concluída'): ?>
                                        <span class="badge bg-success"><?= $op['StatusO'] ?></span>
                                    <?php else: ?>
                                        <span class="badge bg-warning text-dark"><?= $op['StatusO'] ?></span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center p-3">Nenhuma ordem de produção cadastrada.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>