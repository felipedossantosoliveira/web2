<?php
session_start();

if(isset($_POST['nome']) && isset($_POST['salario'])){
    // Armazena o nome em um cookie
    setcookie("nome", $_POST['nome'], time()+3600);

    // Armazena o salário em uma variável de sessão
    $_SESSION['salario'] = $_POST['salario'];
}

header('Location: options.php');
?>
