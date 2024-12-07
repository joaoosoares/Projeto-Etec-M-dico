<?php

class CadMed{
    private $codmed;
    private $nomemed;
    private $espec;
    private $crm;
//-----------------------------
public function getcodmed()
{
    return $this-> codmed;
}
public function setcodmed($CM)
{
    $this->codmed = $CM;
}
//-----------------------------
public function getnomemed()
{
    return $this->nomemed;
}
public function setnomemed($NM)
{
    $this->nomemed = $NM;
}
//-----------------------------
public function getespec()
{
    return $this->espec;
}
public function setespec($ES)
{
    $this->espec = $ES;
}
//-----------------------------
public function getcrm()
{
    return $this->crm;
}
public function setcrm($CR)
{
    $this->crm = $CR;
}
//----------------------------

//Metodo - Gravar os dados no Banco
public function Incluir()
{
    include_once "conexao.php";

    try{
        $Comando=$conexao->prepare("insert into medico (codmed,nomemed,espec,crm) values (?,?,?,?)");
        $Comando->bindParam(1,$this->codmed);
        $Comando->bindParam(2,$this->nomemed);
        $Comando->bindParam(3,$this->espec);
        $Comando->bindParam(4,$this->crm);

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
        $Comando=$conexao->prepare("insert into medico (codmed,nomemed,espec,crm) values (?,?,?,?)");
        $Comando->bindParam(1,$this->codmed);
        $Comando->bindParam(2,$this->nomemed);
        $Comando->bindParam(3,$this->espec);
        $Comando->bindParam(4,$this->crm);

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