<?php

session_start();

if(isset($_GET['option'])) {
    $opcao = $_GET['option'];

    switch($opcao) {
        case 'ferias':
            $_SESSION['ferias'] = $_SESSION['salario'] * 0.33; 
            break;
        case 'ir':
            $_SESSION['ir'] = ir($_SESSION['salario']);
            break;
        case 'aumento':
            $_SESSION['aumento'] = $_SESSION['salario'] * 0.1;
            break;
        default:
            break;
    }

    $_SESSION['opcao'] = $opcao;
    if(!isset($_SESSION[$opcao])) {
        $_SESSION[$opcao] = 1;
    }
}

function ir($salario) {
    switch($salario) {
        case($salario <= 2112):
            return 0;
        case($salario <= 2826.65):
            $calculado = $salario - 1903.98;
            return $calculado * 0.075;
        case($salario <= 3751.05):
            $calculado = $salario - 2826.65;
            return (922.67 * 0.075) + ($calculado * 0.15);
        case($salario <= 4664.68):
            $calculado = $salario - 3751.05;
            return (922.67 * 0.075) + (924.40 * 0.15) + ($calculado * 0.225);
        case($salario > 4664.68):
            $calculado = $salario - 4664.68;
            return (922.67 * 0.075) + (924.40 * 0.15) + (913.63 * 0.225) + ($calculado * 0.275);
        default:
            return 0;
    }
}

header('Location: options.php');
