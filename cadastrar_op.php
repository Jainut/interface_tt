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
            // Chamando a procedure do seu banco de dados
            $sql = "CALL CadastrarOrdemProducao(:codigo, :produto, :qtd, :inicio, :fim, :status)";
            $stmt = $pdo->prepare($sql);
            
            $stmt->bindValue(':codigo', $codigo_ordem);
            $stmt->bindValue(':produto', $id_produto, PDO::PARAM_INT);
            $stmt->bindValue(':qtd', $quantidade, PDO::PARAM_INT);
            $stmt->bindValue(':inicio', $data_inicio);
            $stmt->bindValue(':fim', $data_fim);
            $stmt->bindValue(':status', $status_o);
            
            $stmt->execute();

            echo "<h1>OP Cadastrada com Sucesso!</h1>";
            echo "A ordem de produção <strong>$codigo_ordem</strong> foi criada.<br><br>";
            echo "<a href='cadastro_op.php'>Criar nova OP</a> | <a href='listar_op.php'>Ver todas as OPs</a>";
            
        } catch (PDOException $e) {
            echo "Erro no Banco de Dados: " . $e->getMessage();
            echo "<br><br><a href='cadastro_op.php'>Voltar</a>";
        }
    } else {
        echo "Erro: Todos os campos são obrigatórios.";
        echo "<br><a href='cadastro_op.php'>Voltar</a>";
    }
} else {
    echo "Acesso inválido.";
}
?>