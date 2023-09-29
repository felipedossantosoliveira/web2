<?php
session_start();

if(isset($_GET['option'])){
    $opcao = $_GET['option'];

    switch ($opcao) {
        case 'ferias':
            // Calcular o valor das férias
            $_SESSION['ferias'] = $_SESSION['salario'] * 0.33; // Exemplo de cálculo de férias
            break;
        case 'ir':
            // Calcular o valor do IR
            $_SESSION['ir'] = $_SESSION['salario'] * 0.15; // Exemplo de cálculo de IR
            break;
        case 'aumento':
            // Calcular o aumento de salário
            $_SESSION['aumento'] = $_SESSION['salario'] * 0.1; // Exemplo de cálculo de aumento
            break;
        default:
            break;
    }

    $_SESSION['opcao'] = $opcao;
    if(!isset($_SESSION[$opcao])){
        $_SESSION[$opcao] = 1;
    }
}

header('Location: options.php');
?>
