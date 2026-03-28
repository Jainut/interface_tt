<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require("conexao.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $codigo_ordem = $_POST['codigo_ordem'] ?? null;
    $id_produto   = $_POST['id_produto'] ?? null;
    $quantidade   = $_POST['quantidade'] ?? null;
    $data_inicio  = $_POST['data_inicio'] ?? null;
    $data_fim     = $_POST['data_fim'] ?? null;
    $status_o     = $_POST['status_o'] ?? null;

    if ($codigo_ordem && $id_produto && $quantidade && $data_inicio && $data_fim && $status_o) {
        try {
            $sql = "CALL CadastrarOrdemProducao(:codigo, :produto, :qtd, :inicio, :fim, :status)";
            $stmt = $pdo->prepare($sql);

            $stmt->bindValue(':codigo', $codigo_ordem);
            $stmt->bindValue(':produto', $id_produto, PDO::PARAM_INT);
            $stmt->bindValue(':qtd', $quantidade, PDO::PARAM_INT);
            $stmt->bindValue(':inicio', $data_inicio);
            $stmt->bindValue(':fim', $data_fim);
            $stmt->bindValue(':status', $status_o);

            $stmt->execute();

            header("Location: cadastro_op.php?sucesso=1");
            exit;

        } catch (PDOException $e) {
            header(
                "Location: cadastro_op.php?erro=banco" .
                "&codigo_ordem=" . urlencode($codigo_ordem) .
                "&id_produto=" . urlencode($id_produto) .
                "&quantidade=" . urlencode($quantidade) .
                "&data_inicio=" . urlencode($data_inicio) .
                "&data_fim=" . urlencode($data_fim) .
                "&status_o=" . urlencode($status_o)
            );
            exit;
        }
    }

    header("Location: cadastro_op.php?erro=campos_vazios");
    exit;
}
?>