<?php

session_start();

if (isset($_COOKIE['nome'])) {
    $nome = $_COOKIE['nome'];
} else {
    $nome = "Nome não encontrado";
}

if (isset($_SESSION['opcao'])) {
    $opcao = $_SESSION['opcao'];
} else {
    $_SESSION['opcao'] = "";
    $_SESSION['ferias'] = null;
    $_SESSION['ir'] = null;
    $_SESSION['aumento'] = null;
}

?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="./css/output.css">
    <title>Opções</title>
</head>

<body>
    <section class="flex flex-col items-center justify-center space-y-4 w-screen h-screen">
        <div class="space-y-4 class p-10 rounded-md border bg-slate-50 drop-shadow">
            <h1 class="text-md font-semibold">Olá, <?php echo ucfirst(strtolower($nome)); ?>!</h1>
            <p class="text-sm">Informe o que deseja fazer:</p>
            <ul class="flex flex-col w-full space-y-2">
                <li class="w-full flex">
                    <a class="px-2 py-1 bg-sky-600 text-white rounded-md w-full" href="calculate.php?option=ferias">
                        Calcular suas férias
                    </a>
                </li>
                <li class="w-full flex">
                    <a class="px-2 py-1 bg-sky-600 text-white rounded-md w-full" href="calculate.php?option=ir">
                        Calcular seu imposto de renda
                    </a>
                </li>
                <li class="w-full flex">
                    <a class="px-2 py-1 bg-sky-600 text-white rounded-md w-full" href="calculate.php?option=aumento">
                        Calcular o aumento de salário em 10%
                    </a>
                </li>
            </ul>
            <p class="text-sm">
                Valor do salário: 
                <span class="text-base font-semibold">
                    R$ <?php echo isset($_SESSION['salario']) ? number_format($_SESSION['salario'], 2, ",", ".") : "Não informado"; ?>
                </span>
            </p>
            <p class="text-sm">
                <?php echo isset($_SESSION['count_ferias']) ? $_SESSION['count_ferias'] : "0"; ?> - Valor das férias: 
                <span class="text-base font-semibold">
                    R$ <?php echo isset($_SESSION['ferias']) ? number_format($_SESSION['ferias'], 2, ",", ".") : "Não calculado"; ?>
                </span>
            </p>
            <p class="text-sm">
                <?php echo isset($_SESSION['count_ir']) ? $_SESSION['count_ir'] : "0"; ?> - Valor do IR: 
                <span class="text-base font-semibold">
                    R$ <?php echo isset($_SESSION['ir']) ? number_format($_SESSION['ir'], 2, ",", ".") : "Não calculado"; ?>
                </span>
            </p>
            <p class="text-sm">
                <?php echo isset($_SESSION['count_aumento']) ? $_SESSION['count_aumento'] : "0"; ?> - Valor do aumento salarial: 
                <span class="text-base font-semibold">
                    R$ <?php echo isset($_SESSION['aumento']) ? number_format($_SESSION['aumento'], 2, ",", ".") : "Não calculado"; ?>
                </span>
            </p>
            <p class="w-full flex">
                <a class="px-2 py-1 bg-red-500 text-white rounded-md w-full" href="sair.php">Sair</a>
            </p>
        </div>
    </section>
</body>

</html>