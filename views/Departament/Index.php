<?php
include_once ("../../classes/Departament.class.php");
include_once("../../DAO/DepartamentDAO.class.php");
include_once("../../DAO/CompanyDAO.class.php");
include_once("../../database/Connection.php");

$departament = new Departament();
$departamentDAO = new DepartamentDAO();
$companyDAO = new CompanyDAO();
$company = $companyDAO->select($_GET['companyId']);;
$departaments = $departamentDAO->showByCompany($company['id']);

if (isset($_POST['create-name']) && isset($_POST['create-companyId'])) {
    $departament->setName($_POST['create-name']);
    $departament->setIdCompany($_POST['create-companyId']);
    if($departamentDAO->insert($departament)){
        header("Location: Index.php?companyId=".$company['id']."&created=true");
    }
}

if (isset($_POST['delete'])) {
    $departamentDAO->delete($_POST['delete']);
    header("Location: Index.php?companyId=".$company['id']."&deleted=true");
}

if (isset($_POST['update-name']) && isset($_POST['update-companyId']) && isset($_POST['update-id'])) {
    $departament->setId($_POST['update-id']);
    $departament->setName($_POST['update-name']);
    $departament->setIdCompany($_POST['update-companyId']);
    if($departamentDAO->update($departament)){
        header("Location: Index.php?companyId=".$company['id']."&edited=true");
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/output.css">
    <title>Departamentos</title>
</head>

<script>
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const created = urlParams.get('created')
    const edited = urlParams.get('edited')
    const deleted = urlParams.get('deleted')
    if(created){
        alert("Departamento criado com sucesso!")
    } else if(edited){
        alert("Departamento editado com sucesso!")
    } else if(deleted){
        alert("Departamento deletado com sucesso!")
    } 

    function update(id, name, companyId){
        document.getElementById("create").classList.add("hidden");
        document.getElementById("edit").classList.remove("hidden");
        document.getElementById("title").innerHTML = "Edição de departamento";

        document.getElementById("update-id").value = id;
        document.getElementById("update-name").value = name;
        document.getElementById("update-companyId").value = companyId;
    }
</script>

<body>
    <section class="grid sm:grid-cols-3 gap-y-5">

        <div class="sm:mb-0 mb-3 col-span-full">
            <h2 class="text-3xl font-bold"><?php echo $company['name']?></h2>
        </div>

        <div class="sm:mb-0 mb-3">
            <h2 class="text-2xl font-bold">Departamentos</h2>
            <p id="title" class="text-sm">Criação de departamento</p>
        </div>

        <div id="create" class="sm:col-span-2 border p-4 bg-slate-100 rounded-lg">
            <form action="Index.php?companyId=<?php echo $company['id']; ?>" method="POST" class="flex flex-col gap-2">
                <div class="text-sm">
                    <label class="block" for="create-name">Nome</label>
                    <input id="create-name" autocomplete="off" name="create-name" class="px-3 py-2 rounded border w-full" type="text" placeholder="Nome da departamento">
                </div>
                <input id="create-companyId" name="create-companyId" type="hidden" value="<?php echo $company['id']; ?>">
                <div class="mt-2 flex justify-end">
                    <input type="submit" id="submit" value="Criar departamento" class="px-2 py-1 bg-green-700 text-slate-50 rounded"/>
                </div>
            </form>
        </div>

        <div id="edit" class="hidden sm:col-span-2 border p-4 bg-slate-100 rounded-lg">
            <form action="Index.php?companyId=<?php echo $company['id']; ?>" method="POST" class="flex flex-col gap-2">
                <input type="hidden" name="update-id" id="update-id">
                <div class="text-sm">
                    <label class="block" for="update-name">Nome</label>
                    <input id="update-name" autocomplete="off" name="update-name" class="px-3 py-2 rounded border w-full" type="text" placeholder="Nome da departamento">
                </div>
                    <input id="update-companyId" name="update-companyId" type="hidden" value="<?php echo $company['id']; ?>">
                <div class="mt-2 flex justify-end">
                    <input type="submit" id="submit" value="Editar departamento" class="px-2 py-1 bg-green-700 text-slate-50 rounded"/>
                </div>
            </form>
        </div>

        <hr class="col-span-full my-2">

        <div class="sm:mb-0 mb-3">
            <p class="text-sm">Tabela de departamentos</p>
        </div>

        <div class="sm:col-span-2 border p-4 bg-slate-100 rounded-lg">
            <table class="w-full">
                <thead>
                    <tr class="py-2 border-b border-slate-400 text-slate-700">
                        <th class="text-left">ID</th>
                        <th class="text-left">Name</th>
                        <th class="text-left">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($departaments as $key => $departament) { ?>
                        <tr class="border-b text-sm">
                            <td class="py-2 min-w-[70px]"><?php echo $departament['id']; ?></td>
                            <td class="py-2 w-max-[300px] min-w-[150px] truncate"><?php echo $departament['name']; ?></td>
                            <td class="py-2">
                                <form action="Index.php?companyId=<?php echo $company['id'];?>" method="POST" class="inline-block">
                                    <input type="hidden" name="delete" value="<?php echo $departament['id']; ?>">
                                    <input type="submit" value="Excluir" class="px-2 py-1 bg-red-700 text-slate-50 rounded"/>
                                </form>
                                <button 
                                    onclick="update(<?php echo $departament['id']; ?>, '<?php echo $departament['name']; ?>', '<?php echo $departament['company_id']; ?>')" 
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