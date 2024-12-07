<?php

class CadPaciente{
    private $codpac;
    private $nomepac;
    private $nasc;
    private $tel;
    private $cpf;
//-----------------------------
public function getcodpac()
{
    return $this-> codpac;
}
public function setcodpac($CP)
{
    $this->codpac = $CP;
}
//-----------------------------
public function getnomepac()
{
    return $this->nomepac;
}
public function setnomepac($NP)
{
    $this->nomepac = $NP;
}
//-----------------------------
public function getnasc()
{
    return $this->nasc;
}
public function setnasc($NC)
{
    $this->nasc = $NC;
}
//-----------------------------
public function gettel()
{
    return $this->tel;
}
public function settel($TL)
{
    $this->tel = $TL;
}
//----------------------------
public function getcpf()
{
    return $this->cpf;
}
public function setcpf($CF)
{
    $this->cpf = $CF;
}
//----------------------------

//Metodo - Gravar os dados no Banco
public function Incluir()
{
    include_once "conexao.php";

    try{
        $Comando=$conexao->prepare("insert into paciente (codpac,nomepac,nasc,tel,cpf) values (?,?,?,?,?)");
        $Comando->bindParam(1,$this->codpac);
        $Comando->bindParam(2,$this->nomepac);
        $Comando->bindParam(3,$this->nasc);
        $Comando->bindParam(4,$this->tel);
        $Comando->bindParam(5,$this->cpf);

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
        $Comando=$conexao->prepare("insert into paciente (codpac,nomepac,nasc,tel,cpf) values (?,?,?,?,?)");
        $Comando->bindParam(1,$this->codpac);
        $Comando->bindParam(2,$this->nomepac);
        $Comando->bindParam(3,$this->nasc);
        $Comando->bindParam(4,$this->tel);
        $Comando->bindParam(5,$this->cpf);

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