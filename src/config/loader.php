<?php 

/* Objetivo do loader, será criar funções para carregar as classes  */

function loadModel($modelName){
    require_once(MODEL_PATH . "/${modelName}.php");
}


// os parametros são opcionais, para passar dados entre páginas, é atribuido o valor em uma variavel variavel
function loadView($viewName, $params = array()){
    if(count($params) > 0){
        foreach($params as $key => $value){
            if(strlen($key) > 0){
                ${$key} = $value;
            }
        }
    }
    require_once(VIEW_PATH . "/${viewName}.php");
}