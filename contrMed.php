<?php
include_once "clsMed.php";
$Cad = new CadMed();

$codmed  = filter_input(INPUT_GET,"codmed",FILTER_VALIDATE_INT);
$nomemed  = filter_input(INPUT_GET,"nomemed");
$espec  = filter_input(INPUT_GET,"espec");
$crm   = filter_input(INPUT_GET,"crm");


$Cad->setcodmed($codmed);
$Cad->setnomemed($nomemed);
$Cad->setespec($espec);
$Cad->setcrm($crm);

if (isset($_GET["Incluir"]))
{
    echo $Cad->Incluir();
}
else if (isset($_GET["Apagar"]))
{
    echo $Cad->Apagar();
}