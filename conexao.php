<?php
$host = 'localhost';
$db   = 'atividade_integracao_chao_fabrica_erp2'; // Banco de dados atualizado
$user = 'root';
$pass = ''; // No XAMPP o padrão é vazio. Se usar MAMP, é 'root'.

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    // ESSA LINHA É VITAL: Ela faz o PHP mostrar o erro real do SQL
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro de conexão: " . $e->getMessage());
}
?>