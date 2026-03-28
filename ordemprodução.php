<?php
require("conexao.php");

$sql = $pdo->query(" SELECT * FROM ordemproducao "); $ops =
$sql->fetchAll(PDO::FETCH_ASSOC); ?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Ordem de Produção</title>
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
            rel="stylesheet"
        />
        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css"
        />
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
        <link href="style.css" rel="stylesheet" />
        <script src="index.js" defer></script>
    </head>

    <body class="bg-light">
        <nav class="navbar bg-primary text-white p-3">
            <span class="fs-4">Ordem de Produção</span>
        </nav>

        <button
            type="button"
            class="btn btn-primary position-absolute top-3 start-3 m-3"
            onclick="entrarTela()"
        >
            Voltar
        </button>

        <div class="container mt-5">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-white">
                            <div
                                class="d-flex justify-content-between align-items-center"
                            >
                                <h5 class="mb-0 fw-bold">
                                    <i
                                        class="bi bi-clipboard-data me-2 text-primary"
                                    ></i>
                                    Ordens de Produção
                                </h5>
                                <a
                                    class="btn btn-primary btn-sm"
                                    href="telaordemdeprodução.php"
                                >
                                    <i class="bi bi-plus-circle me-1"></i> Nova
                                    OP
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover" id="tabelaOP">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="border-0">Nº OP</th>
                                            <th class="border-0">Produto</th>
                                            <th class="border-0">Qtd</th>
                                            <th class="border-0">Prazo</th>
                                            <th class="border-0">Status</th>
                                            <th class="border-0">Resp</th>
                                            <th class="border-0 text-center">
                                                Ações
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($ops as $op): ?>
                                        <tr class="align-middle">
                                            <td><?= $op['CodigoDeOrdem'] ?></td>
                                            <td><?= $op['Produto'] ?></td>
                                            <td><?= $op['Quantidade'] ?></td>
                                            <td><?= $op['DataFim'] ?></td>
                                            <td><?= $op['StatusO'] ?></td>
                                            <td class="text-center">
                                                <div
                                                    class="btn-group btn-group-sm"
                                                >
                                                    <a
                                                        href="editar_op.php?id=<?= $op['CodigoDeOrdem'] ?>"
                                                        class="btn btn-outline-primary"
                                                    >
                                                        <i
                                                            class="bi bi-pencil"
                                                        ></i>
                                                    </a>

                                                    <a
                                                        href="excluir_op.php?id=<?= $op['CodigoDeOrdem'] ?>"
                                                        class="btn btn-outline-danger"
                                                        onclick="return confirm('Tem certeza que deseja excluir esta OP?');"
                                                    >
                                                        <i
                                                            class="bi bi-trash"
                                                        ></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Toast Notification -->
        <div class="position-fixed top-0 end-0 p-3">
            <div
                id="notificacao"
                class="toast align-items-center text-bg-success border-0"
                role="alert"
            >
                <div class="d-flex">
                    <div class="toast-body">Dados salvos com sucesso!</div>
                    <button
                        type="button"
                        class="btn-close btn-close-white me-2 m-auto"
                        data-bs-dismiss="toast"
                    ></button>
                </div>
            </div>
        </div>
    </body>
</html>
