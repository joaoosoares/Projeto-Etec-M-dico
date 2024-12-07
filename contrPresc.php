<?php
include_once "clsPresc.php";
$Cad = new CadPresc();

$codpresc  = filter_input(INPUT_GET,"codpresc",FILTER_VALIDATE_INT);
$medica  = filter_input(INPUT_GET,"medica");
$dosag  = filter_input(INPUT_GET,"dosag");
$instr   = filter_input(INPUT_GET,"instr");
$cid   = filter_input(INPUT_GET,"cid");


$Cad->setcodpresc($codpresc);
$Cad->setmedica($medica);
$Cad->setdosag($dosag);
$Cad->setinstr($instr);
$Cad->setcid($cid);

if (isset($_GET["Incluir"]))
{
    echo $Cad->Incluir();
}
else if (isset($_GET["Apagar"]))
{
    echo $Cad->Apagar();
}