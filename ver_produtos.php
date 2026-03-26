<?php
require("conexao.php");
$produtos = $pdo->query("SELECT * FROM produto ORDER BY IdProduto DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">
    <h2>Catálogo de Produtos</h2>
    <table class="table table-hover mt-4">
        <thead class="table-dark">
            <tr><th>ID</th><th>Nome</th><th>Entrada (Trigger)</th><th>Saída Prevista</th></tr>
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
    <a href="index.php" class="btn btn-secondary">Voltar ao Menu</a>
</body>
</html>