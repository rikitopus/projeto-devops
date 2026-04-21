<?php

require_once __DIR__ . '/config/database.php';

// Criar tabela se não existir
$sql = "CREATE TABLE IF NOT EXISTS recados (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    mensagem TEXT NOT NULL,
    data DATE NOT NULL
)";

try {
    $pdo->exec($sql);
    echo "Tabela 'recados' criada ou já existe.\n";
} catch (PDOException $e) {
    die('Erro ao criar tabela: ' . $e->getMessage());
}
