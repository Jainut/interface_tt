<?php
// Ativa a exibição de erros no navegador
ini_set('display_errors', 1);
error_reporting(E_ALL);

require("conexao.php");

// Verifica se os dados chegaram via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $nome      = $_POST['nome'] ?? null;
    $email = $_POST['email'] ?? null;
    $cargo     = $_POST['cargo'] ?? null;
    $senha     = $_POST['senha'] ?? null;
    $ativo     = 1; // True por padrão

    if ($nome && $email && $cargo && $senha) {
        try {
            // Utilizando a Procedure criada no seu banco de dados
            $sql = "CALL CadastrarColaborador(:nome, :email, :cargo, :senha, :ativo)";
            $stmt = $pdo->prepare($sql);
            
            $stmt->bindValue(':nome', $nome);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':cargo', $cargo);
            $stmt->bindValue(':senha', $senha);
            $stmt->bindValue(':ativo', $ativo, PDO::PARAM_INT);
            
            $stmt->execute();

            echo "<h1>Sucesso!</h1>";
            echo "Colaborador <strong>$nome</strong> cadastrado com sucesso. <br><br>";
            echo "<a href='index.php'>Ir Pro Menu</a> | <a href='listar.php'>Voltar Pro Login</a>";
            
        } catch (PDOException $e) {
            // Tratamento específico para a Trigger que criamos no MySQL que bloqueia matrículas duplicadas
            if ($e->getCode() == '45000') {
                echo "<h1>Aviso</h1>";
                echo "Erro: O email '$email' já está cadastrada no sistema. <br><br>";
                echo "<a href='cadastro.htm'>Voltar</a>";
            } else {
                echo "Erro no Banco de Dados: " . $e->getMessage();
            }
        }
    } else {
        echo "Erro: Campos vazios detectados.";
        echo "<br><a href='cadastro.htm'>Voltar</a>";
    }
} else {
    echo "Erro: O formulário não foi enviado via POST.";
}
?>