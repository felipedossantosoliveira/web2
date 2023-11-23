<?php
include_once "../../classes/Companie.class.php";
include_once("../../DAO/CompanieDAO.class.php");
include_once("../../database/Connection.php");

$companie = new Companie();
$companieDAO = new CompanieDAO();
$companies = $companieDAO->show();


if (isset($_POST['create-name']) && isset($_POST['create-cnpj'])) {
    $companie->setName($_POST['name']);
    $companie->setCnpj($_POST['cnpj']);
    if($companieDAO->insert($companie)){
        header("Location: Index.php?success=true");
    }
}

if (isset($_GET['delete'])) {
    $companieDAO->delete($_GET['delete']);
    header("Location: Index.php?deleted=true");
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/output.css">
    <title>Empresas</title>
</head>

<script>
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const success = urlParams.get('success')
    const deleted = urlParams.get('deleted')
    if(success){
        alert("Empresa criada com sucesso!")
    } else if(deleted){
        alert("Empresa deletada com sucesso!")
    } 

</script>

<body>
    <section class="grid sm:grid-cols-3 gap-y-5">

        <div class="sm:mb-0 mb-3">
            <h1 class="text-3xl font-bold">Empresas</h1>
            <p class="text-sm">Criação de empresa</p>
        </div>
        <div class="sm:col-span-2 border p-4 bg-slate-100 rounded-lg">
            <form action="?Index" method="POST" class="flex flex-col gap-2">
                <div class="text-sm">
                    <label class="block" for="create-name">Nome</label>
                    <input autocomplete="off" name="create-name" class="px-3 py-2 rounded border w-full" type="text" placeholder="Nome da empresa">
                </div>
                <div class="text-sm">
                    <label class="block" for="create-cnpj">CNPJ</label>
                    <input autocomplete="off" name="create-cnpj" maxlength="14" minlength="14" class="px-3 py-2 rounded border w-full" type="text" placeholder="CNPJ da empresa">
                </div>
                <div class="mt-2 flex justify-end">
                    <input type="submit" value="Criar empresa" class="px-2 py-1 bg-green-700 text-slate-50 rounded"/>
                </div>
            </form>
        </div>

        <hr class="col-span-full my-2">

        <div class="sm:mb-0 mb-3">
            <p class="text-sm">Tabela de empresas</p>
        </div>
        <div class="sm:col-span-2 border p-4 bg-slate-100 rounded-lg">
            <table class="w-full">
                <thead>
                    <tr class="py-2 border-b border-slate-400 text-slate-700">
                        <th class="text-left">ID</th>
                        <th class="text-left">Name</th>
                        <th class="text-left">Cnpj</th>
                        <th class="text-left">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($companies as $key => $companie) { ?>
                        <tr class="border-b text-sm">
                            <td class="py-2 min-w-[70px]"><?php echo $companie['id']; ?></td>
                            <td class="py-2 w-max-[300px] min-w-[150px] truncate"><?php echo $companie['name']; ?></td>
                            <td class="py-2"><?php echo $companie['cnpj']; ?></td>
                            <td class="py-2">
                                <form action="?Index" method="DELETE" class="inline-block">
                                    <input type="hidden" name="delete" value="<?php echo $companie['id']; ?>">
                                    <input type="submit" value="Excluir" class="px-2 py-1 bg-red-700 text-slate-50 rounded"/>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </section>

</body>

</html>