<?php
require("conexao.php");

// Busca apenas os produtos para exibir na tela
$produtos = $pdo->query("SELECT * FROM produto ORDER BY IdProduto DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Catálogo de Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    
    <nav class="navbar bg-primary text-white p-3 shadow-sm mb-4">
        <span class="fs-4 ms-3">Catálogo de Produtos</span>
    </nav>

    <div class="container py-5">
        <div class="mb-4">
            <a href="index.php" class="btn btn-primary">Voltar</a>
        </div>
        
        <div class="card shadow-sm border-0 p-3">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-primary">
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Entrada (Trigger)</th>
                            <th>Saída Prevista</th>
                            <th>Status Inspeção</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($produtos as $p): ?>
                        <tr>
                            <td><?= $p['IdProduto'] ?></td>
                            <td><?= htmlspecialchars($p['Nome']) ?></td>
                            <td><?= date('d/m/Y H:i', strtotime($p['DataDeEntrada'])) ?></td>
                            <td><?= date('d/m/Y H:i', strtotime($p['DataDeSaida'])) ?></td>
                            
                            <td>
                                <?php if (!$p['Inspecionado']): ?>
                                    <span class="badge bg-warning text-dark">Pendente</span>
                                <?php elseif ($p['Aprovado']): ?>
                                    <span class="badge bg-success">Aprovado</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Reprovado</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
</body>
</html>