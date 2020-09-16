<?php 

/* a requisição chega pelo controller,
sendo a porta de entrada e o mesmo implementa lógica
para saber se é o view, model que serão interagidos */

loadModel('Login');

 // Verifica se usuário está logado através de requisição que vem do formulário
if(count($_POST) > 0){
    $login = new Login($_POST);
    try{
        $user = $login->checkLogin();
        echo "Usuário {$user->name} logado";
    } catch(Exception $e){
        echo 'Falha no login';
    }
}

/* Função responsável por guardar em parametros que são passados
tudo que estava dentro de post foi passado como parametro em view */ 
loadView('login', $_POST);

