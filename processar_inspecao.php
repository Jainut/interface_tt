<?php
// Configurações do banco de dados
$host = 'localhost';
$db   = 'atividade_integracao_chao_fabrica_erp2';
$user = 'root'; 
$pass = ''; 

// Verifica se os dados vieram do formulário via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Pega os dados enviados pelo formulário
    $id_produto = $_POST['id_produto'];
    $status_padrao = $_POST['status_padrao'];
    $observacoes = $_POST['observacoes']; 

    // Prepara as variáveis para o Banco de Dados
    $aprovado = ($status_padrao === 'aprovado') ? 1 : 0;
    $resultado_texto = ($status_padrao === 'aprovado') ? 'Aprovado' : 'Reprovado';

    try {
        // Conecta ao banco
        $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // 1. Salvar na tabela InspecaoQualidade usando a Procedure criada por você
        // Passamos NULL para IdOrdem e IdColab já que a inspeção é direta no produto neste caso
        $sqlInspecao = "CALL CadastrarInspecao(NOW(), 'Inspeção de Qualidade do Produto', :resultado, :observacoes, NULL, NULL)";
        $stmtInspecao = $pdo->prepare($sqlInspecao);
        $stmtInspecao->execute([
            ':resultado' => $resultado_texto,
            ':observacoes' => $observacoes
        ]);

        // 2. Atualiza a tabela 'produto' com o resultado da inspeção
        $sqlProduto = "UPDATE produto SET Inspecionado = TRUE, Aprovado = :aprovado WHERE IdProduto = :id";
        $stmtProduto = $pdo->prepare($sqlProduto);
        $stmtProduto->execute([
            ':aprovado' => $aprovado,
            ':id' => $id_produto
        ]);

        // Se tudo deu certo, avisa o usuário e manda para a tela de relatórios
        echo "<script>
                alert('Inspeção registrada na tabela InspecaoQualidade e Produto atualizado com sucesso!'); 
                window.location.href='ver_relatorios.php';
              </script>";

    } catch (PDOException $e) {
        // Se der erro no banco, mostra o erro e volta pra tela anterior
        echo "<script>
                alert('Erro ao salvar no banco de dados: " . $e->getMessage() . "'); 
                window.history.back();
              </script>";
    }
} else {
    // Redireciona caso tentem acessar via URL diretamente
    header("Location: realizar_inspecao.php");
    exit;
}
?>