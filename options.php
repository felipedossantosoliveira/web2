<?php
session_start();

if(isset($_COOKIE['nome'])){
    $nome = $_COOKIE['nome'];
} else {
    $nome = "Nome não encontrado";
}

if(isset($_SESSION['opcao'])){
    $opcao = $_SESSION['opcao'];
    $_SESSION[$opcao]++;
} else {
    $_SESSION['opcao'] = "";
    $_SESSION['ferias'] = 0;
    $_SESSION['ir'] = 0;
    $_SESSION['aumento'] = 0;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Opções</title>
</head>
<body>
    <h1>Olá, <?php echo $nome; ?>!</h1>
    <p>Informe o que deseja fazer:</p>
    <ul>
        <li><a href="calculate.php?option=ferias">Calcular suas férias</a></li>
        <li><a href="calculate.php?option=ir">Calcular seu imposto de renda, de acordo com a faixa salarial</a></li>
        <li><a href="calculate.php?option=aumento">Calcular o aumento de salário em 10%</a></li>
    </ul>
    <p>1 – Valor do salário: <?php echo isset($_SESSION['salario']) ? $_SESSION['salario'] : "Não informado"; ?></p>
    <p>2 – Valor das férias: <?php echo isset($_SESSION['ferias']) ? $_SESSION['ferias'] : "Não calculado"; ?></p>
    <p>3 – Valor do IR: <?php echo isset($_SESSION['ir']) ? $_SESSION['ir'] : "Não calculado"; ?></p>
    <p>4 – Valor do aumento salarial: <?php echo isset($_SESSION['aumento']) ? $_SESSION['aumento'] : "Não calculado"; ?></p>
    <p><a href="#">Link para voltar à página de opções para continuar calculando</a></p>
    <p><a href="sair.php">Link para sair</a></p>
</body>
</html>
