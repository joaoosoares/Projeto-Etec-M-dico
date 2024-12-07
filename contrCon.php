<?php
include_once "clsCon.php";
$Cad = new CadCon();

$codcon  = filter_input(INPUT_GET,"codcon",FILTER_VALIDATE_INT);
$sintomas  = filter_input(INPUT_GET,"sintomas",FILTER_SANITIZE_SPECIAL_CHARS);
$datacons  = filter_input(INPUT_GET,"datacons", FILTER_SANITIZE_SPECIAL_CHARS);
$hora   = filter_input(INPUT_GET,"hora",FILTER_SANITIZE_SPECIAL_CHARS);
$pacientes = filter_input(INPUT_GET,"pacientes");
$medico = filter_input(INPUT_GET,"medico");
$prescricao = filter_input(INPUT_GET,"prescricao");


$Cad->setcodcon($codcon);
$Cad->setsintomas($sintomas);
$Cad->setdatacons($datacons);
$Cad->sethora($hora);

// Tratamento das ações
if (isset($_GET["Incluir"])) {
    echo $Cad->Incluir();
} elseif (isset($_GET["Apagar"])) {
    echo $Cad->Apagar();
} elseif (isset($_GET["Consultar"])) {
    $dados = $Cad->Consultar();

}

// Cálculo de média se notas forem enviadas via GET
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['notas'])) {
    $notas = filter_input(INPUT_GET, 'notas', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);

    if ($notas && is_array($notas)) {
        $soma_notas = array_sum($notas);
        $num_notas = count($notas);

        if ($num_notas > 0) {
            $media = $soma_notas / $num_notas;
            echo "A média das notas é: " . number_format($media, 2);
        } else {
            echo "Nenhuma nota foi fornecida.";
        }
    } else {
        echo "Erro: As notas devem ser enviadas como um array.";
    }
}
