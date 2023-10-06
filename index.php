<!DOCTYPE html>
<html>
<head>
    <title>Formulário</title>
</head>
<body>
    <h1>Formulário</h1>
    <form action="process.php" method="post">
        Nome: <input type="text" required name="nome"><br>
        Salário: <input type="number" required name="salario"><br>
        <input type="submit" name="enviar" value="Enviar">
        <input type="reset" name="limpar" value="Limpar">
    </form>
</body>
</html>
