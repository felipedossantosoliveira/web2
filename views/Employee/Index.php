<?php
include_once ("../../classes/Employee.class.php");
include_once("../../DAO/EmployeeDAO.class.php");
include_once("../../DAO/DepartamentDAO.class.php");
include_once("../../DAO/CompanyDAO.class.php");
include_once("../../database/Connection.php");

$employee = new Employee();
$employeeDAO = new EmployeeDAO();
$departamentDAO = new DepartamentDAO();
$companyDAO = new CompanyDAO();
$departament = $departamentDAO->select($_GET['departamentId']);
$company = $companyDAO->select($departament['company_id']);
$employees = $employeeDAO->showByDepartament($departament['id']);

if (isset($_POST['create-name']) && isset($departament['id']) && isset($_POST['create-cpf']) && isset($_POST['create-salary'])) {
    $employee->setName($_POST['create-name']);
    $employee->setCpf($_POST['create-cpf']);
    $employee->setSalary($_POST['create-salary']);
    $employee->setIdDepartament($departament['id']);
    if($employeeDAO->insert($employee)){
        header("Location: Index.php?departamentId=".$departament['id']."&created=true");
    }
}

if (isset($_POST['delete'])) {
    $employeeDAO->delete($_POST['delete']);
    header("Location: Index.php?departamentId=".$departament['id']."&deleted=true");
}

if (isset($_POST['update-name']) && isset($departament['id']) && isset($_POST['update-id']) && isset($_POST['update-cpf']) && isset($_POST['update-salary'])) {
    $employee->setId($_POST['update-id']);
    $employee->setName($_POST['update-name']);
    $employee->setCpf($_POST['update-cpf']);
    $employee->setSalary($_POST['update-salary']);
    $employee->setIdDepartament($departament['id']);
    if($employeeDAO->update($employee)){
        header("Location: Index.php?departamentId=".$departament['id']."&edited=true");
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
        alert("Funcionário criado com sucesso!")
    } else if(edited){
        alert("Funcionário editado com sucesso!")
    } else if(deleted){
        alert("Funcionário deletado com sucesso!")
    } 

    function update(id, name, cpf, salary){
        document.getElementById("create").classList.add("hidden");
        document.getElementById("edit").classList.remove("hidden");
        document.getElementById("title").innerHTML = "Edição de funcionário";

        document.getElementById("update-id").value = id;
        document.getElementById("update-name").value = name;
        document.getElementById("update-cpf").value = cpf;
        document.getElementById("update-salary").value = salary;
    }
</script>

<body>
    <header class="w-full py-5 px-10 bg-slate-900 text-slate-100 flex items-center justify-between mb-5">
        <div>
            <h2>
                <a href=".././Departament/Index.php?companyId=<?php echo $company['id']?>" class="hover:underline text-3xl font-semibold">
                    <?php echo $company['name']?>
                </a>
                <a href=".././Departament/Index.php?companyId=<?php echo $company['id']?>" class="text-xl"> > <?php echo $departament['name']?></a>
                <span class="text-xl"> > Funcionários</span>
            </h2>
        </div>
        <nav>
            <a type="button" href=".././Company/Index.php" class="px-2 py-1 bg-slate-700 text-slate-50 rounded">
                Empresas
            </a>
        </nav>
    </header>

    <section class="grid sm:grid-cols-3 gap-y-5">
        <div class="sm:mb-0 mb-3">
            <h2 class="text-2xl font-bold">Funcionários</h2>
            <p id="title" class="text-sm">Criação de funcionário</p>
        </div>

        <div id="create" class="sm:col-span-2 border p-4 bg-slate-100 rounded-lg">
            <form action="Index.php?departamentId=<?php echo $departament['id']; ?>" method="POST" class="flex flex-col gap-2">
                <div class="text-sm">
                    <label class="block" for="create-name">Nome</label>
                    <input id="create-name" autocomplete="off" name="create-name" class="px-3 py-2 rounded border w-full" type="text" placeholder="Nome do funcionário">
                </div>
                <div class="text-sm">
                    <label class="block" for="create-cpf">CPF</label>
                    <input id="create-cpf" autocomplete="off" name="create-cpf" oninput="if(event.data && !/^[0-9]+$/.test(event.data)) this.value = this.value.slice(0, -1)" maxlength="11" minlength="11" class="px-3 py-2 rounded border w-full" type="text" placeholder="CPF">
                </div>
                <div class="text-sm">
                    <label class="block" for="create-salary">Salário</label>
                    <input id="create-salary" autocomplete="off" name="create-salary" class="px-3 py-2 rounded border w-full" type="number" step="any" placeholder="Salário">
                </div>
                <div class="mt-2 flex justify-end">
                    <input type="submit" id="submit" value="Criar funcionário" class="px-2 py-1 bg-green-700 text-slate-50 rounded"/>
                </div>
            </form>
        </div>

        <div id="edit" class="hidden sm:col-span-2 border p-4 bg-slate-100 rounded-lg">
            <form action="Index.php?departamentId=<?php echo $departament['id']; ?>" method="POST" class="flex flex-col gap-2">
                <input type="hidden" name="update-id" id="update-id">
                <div class="text-sm">
                    <label class="block" for="update-name">Nome</label>
                    <input id="update-name" autocomplete="off" name="update-name" class="px-3 py-2 rounded border w-full" type="text" placeholder="Nome da funcionário">
                </div>
                <div class="text-sm">
                    <label class="block" for="update-cpf">CPF</label>
                    <input id="update-cpf" autocomplete="off" name="update-cpf" oninput="if(event.data && !/^[0-9]+$/.test(event.data)) this.value = this.value.slice(0, -1)" maxlength="11" minlength="11" class="px-3 py-2 rounded border w-full" type="text" placeholder="CPF">
                </div>
                <div class="text-sm">
                    <label class="block" for="update-salary">Salário</label>
                    <input id="update-salary" autocomplete="off" name="update-salary" class="px-3 py-2 rounded border w-full" type="number" step="any" placeholder="Salário">
                </div>
                <div class="mt-2 flex justify-end">
                    <input type="submit" id="submit" value="Editar funcionário" class="px-2 py-1 bg-green-700 text-slate-50 rounded"/>
                </div>
            </form>
        </div>

        <hr class="col-span-full my-2">

        <div class="sm:mb-0 mb-3">
            <p class="text-sm">Tabela de funcionários</p>
        </div>

        <div class="sm:col-span-2 border p-4 bg-slate-100 rounded-lg">
            <table class="w-full">
                <thead>
                    <tr class="py-2 border-b border-slate-400 text-slate-700">
                        <th class="text-left">ID</th>
                        <th class="text-left">Name</th>
                        <th class="text-left">CPF</th>
                        <th class="text-left">SALÁRIO</th>
                        <th class="text-left">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if ($employees)
                    foreach ($employees as $key => $employee) { ?>
                        <tr class="border-b text-sm">
                            <td class="py-2 min-w-[70px]"><?php echo $employee['id']; ?></td>
                            <td class="py-2 w-max-[300px] min-w-[150px] truncate"><?php echo $employee['name']; ?></td>
                            <td class="py-2 truncate"><?php echo $employee['cpf']; ?></td>
                            <td class="py-2 truncate"><?php echo $employee['salary']; ?></td>
                            <td class="py-2">
                                <form action="Index.php?departamentId=<?php echo $departament['id'];?>" method="POST" class="inline-block">
                                    <input type="hidden" name="delete" value="<?php echo $employee['id']; ?>">
                                    <input type="submit" value="Excluir" class="cursor-pointer px-2 py-1 bg-red-700 text-slate-50 rounded"/>
                                </form>
                                <button 
                                    onclick="update(<?php echo $employee['id']; ?>, '<?php echo $employee['name']; ?>', '<?php echo $employee['cpf']; ?>', '<?php echo $employee['salary']; ?>')" 
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