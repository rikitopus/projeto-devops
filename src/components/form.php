<?php

// components/form.php
?>
<form action="" method="post">
    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome">
    <label for="data">Data:</label>
    <input type="date" id="data" name="data" value="<?php echo date('Y-m-d'); ?>">
    <label for="mensagem">Mensagem:</label>
    <textarea id="mensagem" name="mensagem"></textarea>
    <button type="submit">Enviar</button>
</form>
