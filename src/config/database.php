<?php

// Conexão com o banco de dados
$db_host = getenv('DB_HOST') ?: 'localhost';
$db_user = getenv('DB_USER') ?: 'devops';
$db_password = getenv('DB_PASSWORD') ?: 'devops_password';
$db_name = getenv('DB_NAME') ?: 'mural_recados';

try {
    $pdo = new PDO(
        "mysql:host=$db_host;dbname=$db_name",
        $db_user,
        $db_password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
} catch (PDOException $e) {
    die('Erro ao conectar ao banco de dados: ' . $e->getMessage());
}
