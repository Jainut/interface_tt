<?php
// Exemplo de conexão com o banco de dados (Ajuste usuário e senha conforme seu ambiente)
$host = 'localhost';
$db   = 'atividade_integracao_chao_fabrica_erp2';
$user = 'root'; // seu usuario do banco
$pass = '';     // sua senha do banco

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    // Busca os produtos que ainda não foram inspecionados
    $stmt = $pdo->query("SELECT IdProduto, Nome, DataDeEntrada FROM produto WHERE Inspecionado = FALSE OR Inspecionado IS NULL");
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $erro = $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realizar Inspeção</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        // Função para atualizar a data de produção automaticamente ao selecionar o produto
        function atualizarData() {
            var select = document.getElementById('produtoSelect');
            var dataProduto = select.options[select.selectedIndex].getAttribute('data-data');
            document.getElementById('dataProducao').value = dataProduto ? dataProduto : '';
        }
    </script>
</head>
<body class="bg-light">

    <nav class="navbar bg-primary text-white p-3 shadow-sm mb-4">
        <span class="fs-4 ms-3">Inspeção de Qualidade</span>
    </nav>

    <div class="d-flex justify-content-center align-items-center mb-5">
        <div class="card p-4 shadow" style="width: 30rem;">
            <h4 class="text-center mb-4">Inspecionar Produto</h4>
            
            <form action="processar_inspecao.php" method="POST">
                
                <div class="mb-3">
                    <label class="form-label">Selecione o Produto</label>
                    <select name="id_produto" id="produtoSelect" class="form-select" onchange="atualizarData()" required>
                        <option value="">-- Selecione --</option>
                        <?php if (!empty($produtos)): ?>
                            <?php foreach ($produtos as $p): ?>
                                <option value="<?= $p['IdProduto'] ?>" data-data="<?= $p['DataDeEntrada'] ?>">
                                    <?= htmlspecialchars($p['Nome']) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <option value="" disabled>Nenhum produto pendente ou erro de conexão</option>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Data de Produção (Entrada)</label>
                    <input type="text" id="dataProducao" class="form-control" readonly placeholder="Selecionar produto...">
                </div>

                <div class="mb-3">
                    <label class="form-label">Status do Padrão</label>
                    <select name="status_padrao" class="form-select" required>
                        <option value="aprovado">Dentro do Padrão (Aprovado)</option>
                        <option value="reprovado">Fora do Padrão (Reprovado)</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Observações (Opcional)</label>
                    <textarea name="observacoes" class="form-control" rows="3" placeholder="Detalhe o motivo caso esteja fora do padrão..."></textarea>
                </div>

                <button type="submit" class="btn btn-info text-white w-100">Registrar Inspeção</button>
                <a href="index.php" class="btn btn-secondary w-100 mt-2">Voltar</a>
            </form>
        </div>
    </div>
</body>
</html>