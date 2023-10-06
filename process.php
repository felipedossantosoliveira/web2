<?php
session_start();

if(isset($_POST['nome']) && isset($_POST['salario'])){
    setcookie("nome", $_POST['nome'], time()+3600);

    $_SESSION['salario'] = $_POST['salario'];
}

header('Location: options.php');
?>
