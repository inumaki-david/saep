<?php
// conexao.php

$host = 'localhost';
$dbname = 'vetsys_db';
$user = 'postgres'; 
$password = 'postgres'; 

try {
    // String de conexão específica para PostgreSQL
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    
    // Configura o PDO para lançar exceções em caso de erros
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdo->exec("SET client_encoding TO 'utf8'");
    
} catch (PDOException $e) {
    die("Erro de conexão com o banco de dados: " . $e->getMessage());
}
?>