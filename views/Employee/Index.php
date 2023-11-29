<?php
include_once ("../../classes/employee.class.php");
include_once("../../DAO/employeeDAO.class.php");
include_once("../../database/Connection.php");

$employee = new employee();
$employeeDAO = new employeeDAO();
$employees = $employeeDAO->show();

if (isset($_POST['create-name']) && isset($_POST['create-cpf'])) {
    $employee->setName($_POST['create-name']);
    $employee->setcpf($_POST['create-cpf']);
    $employee->setSalary($_POST['create-salary']);
	$employee->setIdDepartament($_POST['create-idDepartament']);
    if($employeeDAO->insert($employee)){
        header("Location: Index.php?created=true");
    }
}

if (isset($_POST['delete'])) {
    $employeeDAO->delete($_POST['delete']);
    header("Location: Index.php?deleted=true");
}

if (isset($_POST['update-name']) && isset($_POST['update-cpf']) && isset($_POST['update-id'])) {
    $employee->setId($_POST['update-id']);
    $employee->setName($_POST['update-name']);
    $employee->setcpf($_POST['update-cpf']);
	$employee->setSalary($_POST['update-salary']);
	$employee->setIdDepartament($_POST['update-idDepartament']);
    if($employeeDAO->update($employee)){
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
    <title>Funcionários</title>
</head>

<script>
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const created = urlParams.get('created')
    const edited = urlParams.get('edited')
    const deleted = urlParams.get('deleted')
    if(created){
        alert("Funcionário criada com sucesso!")
    } else if(edited){
        alert("Funcionário editada com sucesso!")
    } else if(deleted){
        alert("Funcionário deletada com sucesso!")
    } 

    function update(id, name, cpf){
        document.getElementById("create").classList.add("hidden");
        document.getElementById("edit").classList.remove("hidden");
        document.getElementById("title").innerHTML = "Edição de Funcionário";

        document.getElementById("update-id").value = id;
        document.getElementById("update-name").value = name;
        document.getElementById("update-cpf").value = cpf;
    }
</script>

<body>
    <section class="grid sm:grid-cols-3 gap-y-5">

        <div class="sm:mb-0 mb-3">
            <h1 class="text-3xl font-bold">Funcionários</h1>
            <p id="title" class="text-sm">Criação de Funcionário</p>
        </div>

        <div id="create" class="sm:col-span-2 border p-4 bg-slate-100 rounded-lg">
            <form action="?Index" method="POST" class="flex flex-col gap-2">
                <div class="text-sm">
                    <label class="block" for="create-name">Nome</label>
                    <input id="create-name" autocomplete="off" name="create-name" class="px-3 py-2 rounded border w-full" type="text" placeholder="Nome da Funcionário">
                </div>
                <div class="text-sm">
                    <label class="block" for="create-cpf">Cpf</label>
                    <input id="create-cpf" autocomplete="off" name="create-cpf" maxlength="11" minlength="11" class="px-3 py-2 rounded border w-full" type="text" placeholder="Cpf da Funcionário">
                </div>
                <div class="mt-2 flex justify-end">
                    <input type="submit" id="submit" value="Criar Funcionário" class="px-2 py-1 bg-green-700 text-slate-50 rounded"/>
                </div>
            </form>
        </div>

        <div id="edit" class="hidden sm:col-span-2 border p-4 bg-slate-100 rounded-lg">
            <form action="?Index" method="POST" class="flex flex-col gap-2">
                <input type="hidden" name="update-id" id="update-id">
                <div class="text-sm">
                    <label class="block" for="update-name">Nome</label>
                    <input id="update-name" autocomplete="off" name="update-name" class="px-3 py-2 rounded border w-full" type="text" placeholder="Nome da Funcionário">
                </div>
                <div class="text-sm">
                    <label class="block" for="update-cpf">Cpf</label>
                    <input id="update-cpf" autocomplete="off" name="update-cpf" maxlength="11" minlength="11" class="px-3 py-2 rounded border w-full" type="text" placeholder="Cpf da Funcionário">
                </div>
				<div class="text-sm">
					<label class="block" for="update-salary">Salário</label>
					<input id="update-salary" autocomplete="off" name="update-salary" class="px-3 py-2 rounded border w-full" type="number" placeholder="Salário da Funcionário">
				</div>
				<div class="text-sm">
					<label class="block" for="update-idDepartament">Departamento</label>
					<input id="update-idDepartament" autocomplete="off" name="update-idDepartament" class="px-3 py-2 rounded border w-full" type="text" placeholder="Departamento da Funcionário">
				</div>

                <div class="mt-2 flex justify-end">
                    <input type="submit" id="submit" value="Editar Funcionário" class="px-2 py-1 bg-green-700 text-slate-50 rounded"/>
                </div>
            </form>
        </div>

        <hr class="col-span-full my-2">

        <div class="sm:mb-0 mb-3">
            <p class="text-sm">Tabela de Funcionários</p>
        </div>

        <div class="sm:col-span-2 border p-4 bg-slate-100 rounded-lg">
            <table class="w-full">
                <thead>
                    <tr class="py-2 border-b border-slate-400 text-slate-700">
                        <th class="text-left">ID</th>
                        <th class="text-left">Name</th>
                        <th class="text-left">cpf</th>
                        <th class="text-left">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($employees as $key => $employee) { ?>
                        <tr class="border-b text-sm">
                            <td class="py-2 min-w-[70px]"><?php echo $employee['id']; ?></td>
                            <td class="py-2 w-max-[300px] min-w-[150px] truncate"><?php echo $employee['name']; ?></td>
                            <td class="py-2"><?php echo $employee['cpf']; ?></td>
                            <td class="py-2">
                                <form action="?Index" method="DELETE" class="inline-block">
                                    <input type="hidden" name="delete" value="<?php echo $employee['id']; ?>">
                                    <input type="submit" value="Excluir" class="px-2 py-1 bg-red-700 text-slate-50 rounded"/>
                                </form>
                                <button 
                                    onclick="update(<?php echo $employee['id']; ?>, '<?php echo $employee['name']; ?>', '<?php echo $employee['cpf']; ?>')" 
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