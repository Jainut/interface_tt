<?php
require("conexao.php");

$sql = $pdo->query("SELECT * FROM ordemproducao");
$ops = $sql->fetchAll(PDO::FETCH_ASSOC);
?>