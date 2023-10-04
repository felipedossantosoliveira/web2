<?php
session_start();

if(isset($_GET['option'])){
    $opcao = $_GET['option'];

    switch ($opcao) {
        case 'ferias':
            // Calcular o valor das férias
            $_SESSION['ferias'] = $_SESSION['salario'] * 0.33; 
            break;
        case 'ir':
            // Calcular o valor do IR
            $_SESSION['ir'] = ir($_SESSION['salario']);
            break;
        case 'aumento':
            // Calcular o aumento de salário
            $_SESSION['aumento'] = $_SESSION['salario'] * 0.1;
            break;
        default:
            break;
    }

    $_SESSION['opcao'] = $opcao;
    if(!isset($_SESSION[$opcao])){
        $_SESSION[$opcao] = 1;
    }
}

function ir($salario){
    switch ($salario){
        case($salario <= 2112):
            return 0;
        case($salario <= 2826.65):
            return ($salario - 1903.98) * 0.075;
        case($salario <= 3751.05):
            $temp = (2826.65 * 0.075) + (($salario - 2826.65)*0.15);
            return $temp;
        default:
            return 0;
    }
}

header('Location: options.php');
?>
