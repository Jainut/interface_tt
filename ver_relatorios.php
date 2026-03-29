<?php
$host = 'localhost';
$db   = 'atividade_integracao_chao_fabrica_erp2';
$user = 'root'; 
$pass = ''; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    // Busca os produtos que já foram inspecionados
    $stmt = $pdo->query("SELECT IdProduto, Nome, DataDeEntrada, Aprovado FROM produto WHERE Inspecionado = TRUE");
    $relatorios = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $erro = $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatórios de Inspeção</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar bg-primary text-white p-3 shadow-sm mb-4">
        <span class="fs-4 ms-3">Relatório das Inspeções</span>
    </nav>

    <div class="container py-4">
        <div class="card shadow p-4">
            <h4 class="mb-4">Histórico de Inspeções de Produtos</h4>
            
            <table class="table table-striped table-hover mt-3">
                <thead class="table-dark">
                    <tr>
                        <th>ID Produto</th>
                        <th>Nome do Produto</th>
                        <th>Data de Produção</th>
                        <th>Status (Qualidade)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($relatorios)): ?>
                        <?php foreach ($relatorios as $row): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['IdProduto']) ?></td>
                                <td><?= htmlspecialchars($row['Nome']) ?></td>
                                <td><?= date('d/m/Y H:i', strtotime($row['DataDeEntrada'])) ?></td>
                                <td>
                                    <?php if ($row['Aprovado'] == 1): ?>
                                        <span class="badge bg-success">Aprovado</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Fora do Padrão</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center">Nenhum relatório encontrado.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            
            <a href="index.php" class="btn btn-secondary mt-3" style="width: 150px;">Voltar ao Menu</a>
        </div>
    </div>
</body>
</html>