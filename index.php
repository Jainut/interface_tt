<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>ERP - Chão de Fábrica</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar bg-primary text-white p-3 shadow-sm mb-4">
        <span class="fs-4 ms-3">Gestão de Fábrica</span>
    </nav>

    <div class="container py-5">
        <h1 class="text-center mb-5">Menu Principal - ERP</h1>

        <div class="row justify-content-center gap-3">
            
            <div class="col-md-4">
                <div class="card shadow-sm text-center p-3">
                    <h5>Produtos</h5>
                    <a href="cadastro_produto.htm" class="btn btn-success mb-2">Novo Produto</a>
                    <a href="ver_produtos.php" class="btn btn-outline-success">Ver Catálogo</a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm text-center p-3">
                    <h5>Ordens de Produção</h5>
                    <a href="telaordemdeprodução.htm" class="btn btn-warning mb-2">Criar Nova OP</a>
                    <a href="ordemprodução.htm" class="btn btn-outline-warning">Monitorar OPs</a>
                </div>
            </div>

        </div>
    </div>
</body>
</html>