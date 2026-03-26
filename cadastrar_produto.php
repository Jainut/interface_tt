<?php
require("conexao.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'] ?? null;
    $data_saida = $_POST['data_saida'] ?? null;

    if ($nome && $data_saida) {
        try {
            // Chama a procedure: CadastrarProduto(Nome, DataSaida)
            $stmt = $pdo->prepare("CALL CadastrarProduto(?, ?)");
            $stmt->execute([$nome, $data_saida]);

            echo "<script>alert('Produto cadastrado!'); window.location.href='index.php';</script>";
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    }
}
?>