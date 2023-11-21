<?php
include_once "../../classes/Companie.class.php";
include_once("../../DAO/CompanieDAO.class.php");
include_once("../../database/Connection.php");

$companie = new Companie();
$companieDAO = new CompanieDAO();
$companies = $companieDAO->show();

echo $companies;
?>
