<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mural de Recados</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Mural de Recados</h1>
    <?php include 'components/form.php'; ?>

    <hr>

    <h2>Últimos Recados</h2>
    <?php
        require_once __DIR__ . '/config/database.php';

    try {
        $sql = "SELECT nome, mensagem, data FROM recados ORDER BY data DESC LIMIT 10";
        $stmt = $pdo->query($sql);
        $recados = $stmt->fetchAll();

        if (empty($recados)) {
            echo '<p>Nenhum recado registrado ainda.</p>';
        } else {
            foreach ($recados as $recado) {
                $nome = $recado['nome'];
                $mensagem = $recado['mensagem'];
                $data = $recado['data'];
                include 'components/recado.php';
            }
        }
    } catch (PDOException $e) {
        echo '<p>Nenhum recado registrado ainda.</p>';
    }
    ?>
</body>
</html>

