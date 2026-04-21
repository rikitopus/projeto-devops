<?php

require_once __DIR__ . '/../config/database.php';

$errors = [];
$success = false;

// Manipular o envio do formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $mensagem = trim($_POST['mensagem'] ?? '');
    $data = $_POST['data'] ?? '';

    // Validação
    if (empty($nome)) {
        $errors[] = 'Nome é obrigatório.';
    }
    if (empty($mensagem)) {
        $errors[] = 'Mensagem é obrigatória.';
    }
    if (empty($data)) {
        $errors[] = 'Data é obrigatória.';
    } else {
        // Verificar se a data não é no futuro
        $today = date('Y-m-d');
        if ($data > $today) {
            $errors[] = 'A data não pode ser no futuro.';
        }
    }

    // Se não há erros, inserir no banco de dados
    if (empty($errors)) {
        try {
            $sql = "INSERT INTO recados (nome, mensagem, data) VALUES (:nome, :mensagem, :data)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':nome' => $nome,
                ':mensagem' => $mensagem,
                ':data' => $data,
            ]);
            $success = true;
        } catch (PDOException $e) {
            $errors[] = 'Erro ao salvar recado: ' . $e->getMessage();
        }
    }
}

?>

<?php if (!empty($errors)) : ?>
    <div class="erros">
        <?php foreach ($errors as $error) : ?>
            <p class="erro"><?php echo htmlspecialchars($error); ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php if ($success) : ?>
    <p class="sucesso">Recado enviado com sucesso!</p>
<?php endif; ?>

<form action="" method="post">
    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($_POST['nome'] ?? ''); ?>" required>

    <label for="data">Data:</label>
    <input 
        type="date" 
        id="data" 
        name="data" 
        value="<?php echo htmlspecialchars($_POST['data'] ?? date('Y-m-d')); ?>" 
        max="<?php echo date('Y-m-d'); ?>" 
        required
    >

    <label for="mensagem">Mensagem:</label>
    <textarea id="mensagem" name="mensagem" required>
        <?php echo htmlspecialchars($_POST['mensagem'] ?? ''); ?>
    </textarea>

    <button type="submit">Enviar</button>
</form>
