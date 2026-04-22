<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../Validators/DateValidator.php';
require_once __DIR__ . '/../Validators/NameValidator.php';
require_once __DIR__ . '/../Validators/MessageValidator.php';

use App\Validators\DateValidator;
use App\Validators\NameValidator;
use App\Validators\MessageValidator;

$errors = [];
$success = false;

// Manipular o envio do formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Trim valores imediatamente após recebê-los
    $nome = trim($_POST['nome'] ?? '');
    $mensagem = trim($_POST['mensagem'] ?? '');
    $data = $_POST['data'] ?? '';

    // Validar nome usando o NameValidator
    $nameErrors = NameValidator::validate($nome);
    $errors = array_merge($errors, $nameErrors);

    // Validar mensagem usando o MessageValidator
    $messageErrors = MessageValidator::validate($mensagem);
    $errors = array_merge($errors, $messageErrors);

    // Validar data usando o DateValidator
    $dateErrors = DateValidator::validate($data);
    $errors = array_merge($errors, $dateErrors);

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
            // Limpar os valores após sucesso
            $nome = '';
            $mensagem = '';
            $data = '';
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
    <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($nome ?? ''); ?>" required>

    <label for="data">Data:</label>
    <input
        type="date"
        id="data"
        name="data"
        value="<?php echo htmlspecialchars($data ?? date('Y-m-d')); ?>"
        max="<?php echo date('Y-m-d'); ?>"
        required
    >

    <label for="mensagem">Mensagem:</label>
    <textarea id="mensagem" name="mensagem" maxlength="200" required>
        <?php echo htmlspecialchars($mensagem ?? ''); ?>
    </textarea>

    <button type="submit">Enviar</button>
</form>
