<?php
require("conexao.php");
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
    
    <div class="container py-5">
        <div class="mb-4">
            <a href="index.php" class="btn btn-outline-success">&laquo; Voltar ao Menu</a>
        </div>

        <h2 class="text-success mb-4">Catálogo de Produtos</h2>
        
        <div class="card shadow-sm border-0 p-3">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-success">
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Entrada (Trigger)</th>
                            <th>Saída Prevista</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($produtos as $p): ?>
                        <tr>
                            <td><?= $p['IdProduto'] ?></td>
                            <td><?= $p['Nome'] ?></td>
                            <td><?= date('d/m/Y H:i', strtotime($p['DataDeEntrada'])) ?></td>
                            <td><?= date('d/m/Y H:i', strtotime($p['DataDeSaida'])) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
</body>
</html>