<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="./css/output.css">
    <title>Formulário</title>
</head>
<body>
    <section class="flex items-center justify-center w-screen h-screen">
        <div class="space-y-4 class p-10 rounded-md border bg-slate-50 drop-shadow">
            <h1 class="text-md font-semibold">Calculadora de salário</h1>
            <form class="flex flex-col space-y-4" action="process.php" method="post">
                <div class="space-y-2 flex flex-col">
                    <div>
                        <label class="text-sm" for="nome">Nome:</label>
                        <input class="px-2 py-1 rounded-md border-sky-500 border-2 w-full" type="text" required name="nome">
                    </div>
                    <div>
                        <label class="text-sm" for="salario">Salário:</label>
                        <input class="px-2 py-1 rounded-md border-sky-500 border-2 w-full" type="number" required name="salario"><br>
                    </div>
                </div>
                <div class="space-y-2 flex flex-col">
                    <button class="cursor-pointer py-1 px-2 rounded bg-green-500 text-white drop-shadow" type="submit" name="enviar">
                        Enviar
                    </button>
                    <button class="cursor-pointer py-1 px-2 rounded bg-red-500 text-white drop-shadow" type="reset" name="limpar">
                        Limpar
                    </button>
                </div>
            </form>
        </div>
    </section>
</body>
</html>
