<?php

/* Todos os erros estão guardados na variavel,
   evitando problemas de renderização, necessitando importar o arquivo na view */
$errors = [];
// Aqui será a lógica para imprimir as mensagens em tela
if (isset($exception)) {
    $message = [
        'type' => 'error',
        'message' => $exception->getMessage()
    ];

    if (get_class($exception) === 'ValidationException') {
        $errors = $exception->getErrors();
    }
}


// Verificação do tipo de mensagem
$alertType = '';
if (isset($message)) {
    if ($message['type'] === 'error') {
        $alertType = 'danger';
    } else {
        $alertType = 'success';
    }
}

?>

<?php if (isset($message)) : ?>

    <div role="alert" class="alert my-3 alert-<?= $alertType ?>">
        <?= $message['message'] ?>
    </div>

<?php endif ?>