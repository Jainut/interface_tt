<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require("conexao.php");

try {
    // Busca todos os colaboradores
    $sql = "SELECT IdColaborador, Nome, Matricula, Cargo, Setor, Ativo FROM Colaborador";
    $stmt = $pdo->query($sql);
    $colaboradores = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro ao buscar dados: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Colaboradores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4 bg-light">

    <div class="container">
        <h2 class="mb-4">Colaboradores Cadastrados</h2>
        
        <a href="cadastro.htm" class="btn btn-success mb-3">Novo Colaborador</a>

        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Matrícula</th>
                    <th>Cargo</th>
                    <th>Setor</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($colaboradores) > 0): ?>
                    <?php foreach ($colaboradores as $colab): ?>
                        <tr>
                            <td><?= $colab['IdColaborador'] ?></td>
                            <td><?= htmlspecialchars($colab['Nome']) ?></td>
                            <td><?= htmlspecialchars($colab['Matricula']) ?></td>
                            <td><?= htmlspecialchars($colab['Cargo']) ?></td>
                            <td><?= htmlspecialchars($colab['Setor']) ?></td>
                            <td><?= $colab['Ativo'] ? 'Ativo' : 'Inativo' ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">Nenhum colaborador encontrado.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>
</html>