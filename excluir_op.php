<?php
require("conexao.php");

$id = $_GET['id'] ?? null;

if ($id) {
    try {
        $stmt = $pdo->prepare("DELETE FROM ordemproducao WHERE CodigoDeOrdem = :id");
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        
        header("Location: ordemprodução.php?sucesso_excluir=1");
        exit;
    } catch (PDOException $e) {
        header("Location: ordemprodução.php?erro_excluir=1");
        exit;
    }
} else {
    header("Location: ordemprodução.php");
    exit;
}
?>