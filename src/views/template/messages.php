<?php 

// Aqui será a lógica para imprimir as mensagens em tela
if($exception){
    $message = [
        'type' => 'error',
        'message' => $exception->getMessage()
    ];
}

?>

<?php if($message): ?>
    
<div class="alert alert-danger my-3" role="alert">
    <?= $message['message'] ?>
</div>

<?php endif ?>