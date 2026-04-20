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
        $recados = [
            ["nome" => "Ricardo", "mensagem" => "Este é o primeiro recado!", "data" => "2026-04-19"],
            ["nome" => "Maria", "mensagem" => "Olá, pessoal! Tudo bem?", "data" => "2026-04-18"],
            ["nome" => "João", "mensagem" => "Testando o mural de recados.", "data" => "2026-04-17"],
        ];

        foreach ($recados as $recado) {
            $nome = $recado['nome'];
            $mensagem = $recado['mensagem'];
            $data = $recado['data'];
            include 'components/recado.php';
        }
        ?>
</body>
</html>

