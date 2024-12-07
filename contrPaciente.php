<?php
include_once "clsPaciente.php";
$Cad = new CadPaciente();

$codpac  = filter_input(INPUT_GET,"codpac",FILTER_VALIDATE_INT);
$nomepac  = filter_input(INPUT_GET,"nomepac");
$nasc  = filter_input(INPUT_GET,"nasc");
$tel   = filter_input(INPUT_GET,"tel");
$cpf   = filter_input(INPUT_GET,"cpf");


$Cad->setcodpac($codpac);
$Cad->setnomepac($nomepac);
$Cad->setnasc($nasc);
$Cad->settel($tel);
$Cad->setcpf($cpf);

if (isset($_GET["Incluir"]))
{
    echo $Cad->Incluir();
}
else if (isset($_GET["Apagar"]))
{
    echo $Cad->Apagar();
}