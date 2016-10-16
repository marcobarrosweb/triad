<?php

session_start();

//INICIALIZA A CLASSE AUTOLOAD, INCLUINDO APENAS A CLASSE USUARIO PARA REALIZAR LOGIN
function __autoload($classe) {
    $pastas = array('control',
        'control/usuario',
        'model',
        'model/usuario'
    );
    foreach ($pastas as $pasta) {
        if (file_exists("{$pasta}/{$classe}.class.php")) {//VERIFICA SE O DIRETÓRIO EXISTE
            include_once("{$pasta}/{$classe}.class.php"); //INCLUI AS PÁGINAS/CLASSES
        }
    }
}

if (!empty($_REQUEST["method"]) and ! empty($_REQUEST["class"])) {

    $class = $_REQUEST["class"];
    $usuarioModel = new $class;
    // Método
    $method = $_REQUEST["method"];
    // Parametros.
    $parameter = $_REQUEST;

    $retorno = call_user_func_array(array($usuarioModel, $method), array($parameter));
    echo json_encode($retorno);
}
