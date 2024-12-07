<?php

class CadPresc{
    private $codpresc;
    private $medica;
    private $dosag;
    private $instr;
    private $cid;
//-----------------------------
public function getcodpresc()
{
    return $this-> codpresc;
}
public function setcodpresc($CR)
{
    $this->codpresc = $CR;
}
//-----------------------------
public function getmedica()
{
    return $this->medica;
}
public function setmedica($MD)
{
    $this->medica = $MD;
}
//-----------------------------
public function getdosag()
{
    return $this->dosag;
}
public function setdosag($DS)
{
    $this->dosag = $DS;
}
//-----------------------------
public function getinstr()
{
    return $this->instr;
}
public function setinstr($IT)
{
    $this->instr = $IT;
}
//----------------------------
public function getcid()
{
    return $this->cid;
}
public function setcid($CI)
{
    $this->cid = $CI;
}
//----------------------------

//Metodo - Gravar os dados no Banco
public function Incluir()
{
    include_once "conexao.php";

    try{
        $Comando=$conexao->prepare("insert into prescricao (codpresc,medica,dosag,instr,cid) values (?,?,?,?,?)");
        $Comando->bindParam(1,$this->codpresc);
        $Comando->bindParam(2,$this->medica);
        $Comando->bindParam(3,$this->dosag);
        $Comando->bindParam(4,$this->instr);
        $Comando->bindParam(5,$this->cid);

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
        $Comando=$conexao->prepare("insert into prescricao (codpresc,medica,dosag,instr,cid) values (?,?,?,?,?)");
        $Comando->bindParam(1,$this->codpresc);
        $Comando->bindParam(2,$this->medica);
        $Comando->bindParam(3,$this->dosag);
        $Comando->bindParam(4,$this->instr);
        $Comando->bindParam(5,$this->cid);

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