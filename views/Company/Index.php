<?php
include_once ("../../classes/Company.class.php");
include_once("../../DAO/CompanyDAO.class.php");
include_once("../../database/Connection.php");

$company = new Company();
$CompanyDAO = new CompanyDAO();
$companies = $CompanyDAO->show();

if (isset($_POST['create-name']) && isset($_POST['create-cnpj'])) {
    $company->setName($_POST['create-name']);
    $company->setCnpj($_POST['create-cnpj']);
    if($CompanyDAO->insert($company)){
        header("Location: Index.php?created=true");
    }
}

if (isset($_POST['delete'])) {
    $CompanyDAO->delete($_POST['delete']);
    header("Location: Index.php?deleted=true");
}

if (isset($_POST['update-name']) && isset($_POST['update-cnpj']) && isset($_POST['update-id'])) {
    $company->setId($_POST['update-id']);
    $company->setName($_POST['update-name']);
    $company->setCnpj($_POST['update-cnpj']);
    if($CompanyDAO->update($company)){
        header("Location: Index.php?edited=true");
    }
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
    const created = urlParams.get('created')
    const edited = urlParams.get('edited')
    const deleted = urlParams.get('deleted')
    if(created){
        alert("Empresa criada com sucesso!")
    } else if(edited){
        alert("Empresa editada com sucesso!")
    } else if(deleted){
        alert("Empresa deletada com sucesso!")
    } 

    function update(id, name, cnpj){
        document.getElementById("create").classList.add("hidden");
        document.getElementById("edit").classList.remove("hidden");
        document.getElementById("title").innerHTML = "Edição de empresa";

        document.getElementById("update-id").value = id;
        document.getElementById("update-name").value = name;
        document.getElementById("update-cnpj").value = cnpj;
    }
</script>

<body>
    <section class="grid sm:grid-cols-3 gap-y-5">

        <div class="sm:mb-0 mb-3">
            <h1 class="text-3xl font-bold">Empresas</h1>
            <p id="title" class="text-sm">Criação de empresa</p>
        </div>

        <div id="create" class="sm:col-span-2 border p-4 bg-slate-100 rounded-lg">
            <form action="?Index" method="POST" class="flex flex-col gap-2">
                <div class="text-sm">
                    <label class="block" for="create-name">Nome</label>
                    <input id="create-name" autocomplete="off" name="create-name" class="px-3 py-2 rounded border w-full" type="text" placeholder="Nome da empresa">
                </div>
                <div class="text-sm">
                    <label class="block" for="create-cnpj">CNPJ</label>
                    <input id="create-cnpj" autocomplete="off" name="create-cnpj" maxlength="14" minlength="14" class="px-3 py-2 rounded border w-full" type="text" placeholder="CNPJ da empresa">
                </div>
                <div class="mt-2 flex justify-end">
                    <input type="submit" id="submit" value="Criar empresa" class="px-2 py-1 bg-green-700 text-slate-50 rounded"/>
                </div>
            </form>
        </div>

        <div id="edit" class="hidden sm:col-span-2 border p-4 bg-slate-100 rounded-lg">
            <form action="?Index" method="POST" class="flex flex-col gap-2">
                <input type="hidden" name="update-id" id="update-id">
                <div class="text-sm">
                    <label class="block" for="update-name">Nome</label>
                    <input id="update-name" autocomplete="off" name="update-name" class="px-3 py-2 rounded border w-full" type="text" placeholder="Nome da empresa">
                </div>
                <div class="text-sm">
                    <label class="block" for="update-cnpj">CNPJ</label>
                    <input id="update-cnpj" autocomplete="off" name="update-cnpj" maxlength="14" minlength="14" class="px-3 py-2 rounded border w-full" type="text" placeholder="CNPJ da empresa">
                </div>
                <div class="mt-2 flex justify-end">
                    <input type="submit" id="submit" value="Editar empresa" class="px-2 py-1 bg-green-700 text-slate-50 rounded"/>
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
                    <?php foreach ($companies as $key => $company) { ?>
                        <tr class="border-b text-sm">
                            <td class="py-2 min-w-[70px]"><?php echo $company['id']; ?></td>
                            <td class="py-2 w-max-[300px] min-w-[150px] truncate"><?php echo $company['name']; ?></td>
                            <td class="py-2"><?php echo $company['cnpj']; ?></td>
                            <td class="py-2">
                                <form action="?Index" method="DELETE" class="inline-block">
                                    <input type="hidden" name="delete" value="<?php echo $company['id']; ?>">
                                    <input type="submit" value="Excluir" class="px-2 py-1 bg-red-700 text-slate-50 rounded"/>
                                </form>
                                <button 
                                    onclick="update(<?php echo $company['id']; ?>, '<?php echo $company['name']; ?>', '<?php echo $company['cnpj']; ?>')" 
                                    class="px-2 py-1 bg-yellow-700 text-slate-50 rounded">
                                    Editar
                                </button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </section>

</body>

</html>