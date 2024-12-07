<?php

class CadCon{
    private $codcon;
    private $datacons;
    private $hora;
    private $sintomas;
    private $paciente;
    private $medico;
    private $prescricao;
//-----------------------------
public function getcodcon()
{
    return $this-> codcon;
}
public function setcodcon($CC)
{
    $this->codcon = $CC;
}
//-----------------------------
public function getdatacons()
{
    return $this->datacons;
}
public function setdatacons($DC)
{
    $this->datacons = $DC;
}
//-----------------------------
public function gethora()
{
    return $this->hora;
}
public function sethora($HR)
{
    $this->hora = $HR;
}
//-----------------------------
public function getsintomas()
{
    return $this->sintomas;
}
public function setsintomas($ST)
{
    $this->sintomas = $ST;
}
//----------------------------
public function getpaciente()
{
    return $this->paciente;
}
public function setpaciente($PC)
{
    $this->paciente = $PC;
}
//----------------------------
public function getmedico()
{
    return $this->medico;
}
public function setmedico($MD)
{
    $this->medico = $MD;
}
//----------------------------
public function getprescricao()
{
    return $this->prescricao;
}
public function setprecricao($PR)
{
    $this->prescricao = $PR;
}
//----------------------------

//Metodo - Gravar os dados no Banco
public function Incluir()
{
    include_once "conexao.php";

    try{
        $Comando=$conexao->prepare("insert into consulta (codcon,datacons,hora,sintomas,paciente,medico,prescricao) values (?,?,?,?,?,?,?)");
        $Comando->bindParam(1,$this->codcon);
        $Comando->bindParam(2,$this->datacons);
        $Comando->bindParam(3,$this->hora);
        $Comando->bindParam(4,$this->sintomas);
        $Comando->bindParam(5,$this->paciente);
        $Comando->bindParam(6,$this->medico);
        $Comando->bindParam(7,$this->prescricao);

        if($Comando->execute())
        {
            $Retorno = "Gravado com sucesso";
        }
    }catch (PDOException $Erro)
    {
        $Retorno = "Erro " . $Erro->getMessage();
    }
    return $Retorno;
}
public function Apagar()
{
    include_once "conexao.php";

    try{
        $Comando=$conexao->prepare("insert into consulta (codcon,datacons,hora,sintomas,paciente,medico,prescricao) values (?,?,?,?,?,?,?)");
        $Comando->bindParam(1,$this->codcon);
        $Comando->bindParam(2,$this->datacons);
        $Comando->bindParam(3,$this->hora);
        $Comando->bindParam(4,$this->sintomas);
        $Comando->bindParam(5,$this->paciente);
        $Comando->bindParam(6,$this->medico);
        $Comando->bindParam(7,$this->prescricao);

        if($Comando->execute())
        {
            $Retorno = "Gravado com sucesso";
        }
    }catch (PDOException $Erro)
    {
        $Retorno = "Erro " . $Erro->getMessage();
    }
    return $Retorno;
}
}