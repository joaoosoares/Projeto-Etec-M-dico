<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro e Consulta</title>
    <link rel="stylesheet" type="text/css" href="adicionando.css" media="screen" />
    
</head>
<body onload="consultar()">
    <?php include "menu.php"; ?>
	
<h2>Cadastro de Pacientes</h2>

<!-- Botão para abrir o modal de cadastro -->
<button id="abrindoModalBtn">Clique para Inserir Dados</button>

<!-- Modal de Cadastro -->
<div id="meuModalCadastro" class="modal">
    <div class="modal-content">
        <span class="close" id="fecharModalCadastroBtn">&times;</span>
        <h5>Cadastrar Paciente</h5>
        <input id="codpac" placeholder="Código:"/><br>    
        <input id="nomepac" placeholder="Nome:" /><br>
        <input type="date" id="nasc" placeholder="Nascimento:" /><br>
        <input id="tel" placeholder="Telefone:" /><br>  
        <input id="cpf" placeholder="CPF:" /><br>   
        <button onclick="cadastrar()">Cadastrar</button>
        <p id="resultadoCadastro"></p>
    </div>
</div>

<h2>Pacientes cadastrados</h2>
<div id="resultado">
    <!-- Tabela com os resultados será gerada aqui -->
</div>

<!-- Modal de Atualização -->
<div id="meuModalAtualizacao" class="modal">
    <div class="modal-content">
        <span class="close" id="fecharModalAtualizacaoBtn">&times;</span>
        <h5>Atualização do Paciente</h5>
        <input id="codpac" placeholder="Código:"/><br>    
        <input id="nomepac" placeholder="Nome:" /><br>
        <input type="date" id="nasc" placeholder="Nascimento:" /><br>
        <input id="tel" placeholder="Telefone:" /><br>  
        <input id="cpf" placeholder="CPF:" /><br>     
        <button onclick="salvarAtualizacao()">Atualizar</button>
        <p id="resultadoAtualizacao"></p>
    </div>
</div>

<script>
    // Função para consultar e exibir os dados cadastrados
    function consultar() {
        const xhttp = new XMLHttpRequest();
        xhttp.open("GET", "contrPaciente.php?Consultar");
        xhttp.send();

        xhttp.onload = function() {
            var resposta = JSON.parse(this.responseText);
            var organizar = "<table><thead><tr><th>Código</th><th>Nome</th><th>Nascimento</th><th>Telefone</th><th>CPF</th></thead><tbody>";
            for (var i = 0; i < resposta.length; i++) {
                organizar += "<tr><td>" + resposta[i].codpac + "</td>" +
                    "<td>" + resposta[i].nomepac + "</td>" +
                    "<td>" + resposta[i].nasc + "</td>" +
                    "<td>" + resposta[i].tel + "</td>" +
                    "<td>" + resposta[i].cpf + "</td>" +
                    
                    
                    "<td>" +
                    "<button class='action-button' onclick='atualizar(" + resposta[i].codpac + ")'>Atualizar</button>" +
                    "<button class='delete-button' onclick='apagar(" + resposta[i].codpac + ")'>Apagar</button>" +
                    "</td></tr>";
            }
            organizar += "</tbody></table>";
            document.getElementById('resultado').innerHTML = organizar;
        }
    }

    // Função para cadastrar uma nova pessoa
    function cadastrar() {
        var codpac = document.getElementById("codpac").value;
        var nomepac = document.getElementById("nomepac").value;
        var nasc = document.getElementById("nasc").value;
        var tel = document.getElementById("tel").value;
        var cpf = document.getElementById("cpf").value;
        
        
        const xhttp = new XMLHttpRequest();
        xhttp.open("POST", "contrPaciente.php?Incluir", true);
        xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        var data = "codpac=" + encodeURIComponent(codpac) +
            "&nomepac=" + encodeURIComponent(nomepac) +
            "&nasc=" + encodeURIComponent(nasc) +
            "&tel=" + encodeURIComponent(tel)+
            "&cpf=" + encodeURIComponent(cpf);

        xhttp.send(data);
      
        xhttp.onload = function() {
            document.getElementById("resultadoCadastro").innerHTML = this.responseText;
        }
        consultar();
    }

    // Função para abrir o modal de cadastro
    var modalCadastro = document.getElementById("meuModalCadastro");
    var btnCadastro = document.getElementById("abrindoModalBtn");
    var spanCadastro = document.getElementById("fecharModalCadastroBtn");

    btnCadastro.onclick = function() {
        modalCadastro.style.display = "block";
    }

    // Função para fechar o modal de cadastro
    spanCadastro.onclick = function() {
        modalCadastro.style.display = "none";
    }

    // Função para fechar a modal de cadastro se clicar fora dela
    window.onclick = function(event) {
        if (event.target == modalCadastro) {
            modalCadastro.style.display = "none";
        }
    }

    // Função para exibir os dados de uma pessoa para atualizar
    function atualizar(codpac) {
        // Buscar os dados dessa pessoa
        const xhttp = new XMLHttpRequest();
        xhttp.open("GET", "contrPac.php?Consultar");
        xhttp.send();

        xhttp.onload = function() {
            var resposta = JSON.parse(this.responseText);
            for (var i = 0; i < resposta.length; i++) {
                if(matricula==resposta[i].matricula){
                    // Preencher os campos do formulário com os dados do boletim
                    document.getElementById("codpac").value = resposta[i].codpac; // A matrícula não pode ser alterado
                    document.getElementById("nomepac").value = resposta[i].nomepac;
                    document.getElementById("nasc").value = resposta[i].nasc;
                    document.getElementById("tel").value = resposta[i].tel;
                    document.getElementById("cpf").value = resposta[i].cpf;
                }
            }
            // Exibir o modal de atualização
            var modalAtualizacao = document.getElementById("meuModalAtualizacao");
            modalAtualizacao.style.display = "block";
        };
    }

    // Função para salvar as atualizações
    function salvarAtualizacao() {
        var codpac = document.getElementById("codpac").value;
        var nomepac = document.getElementById("nomepac").value;
        var nasc = document.getElementById("nasc").value;
        var tel = document.getElementById("tel").value;
        var cpf = document.getElementById("cpf").value;
        

        const xhttp = new XMLHttpRequest();
        xhttp.open("POST", "contrMed.php?Atualizar", true);
        xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        var data = "codpac=" + encodeURIComponent(codpac) +
            "&nomepac=" + encodeURIComponent(nomepac) +
            "&nasc=" + encodeURIComponent(nasc) +
            "&tel=" + encodeURIComponent(tel)+
            "&cpf=" + encodeURIComponent(cpf);

        xhttp.send(data);
        consultar();
        xhttp.onload = function() {
            document.getElementById("resultadoAtualizacao").innerHTML = this.responseText;
            consultar();
        }
        consultar();
        // Fechar a modal após salvar
        var modalAtualizacao = document.getElementById("meuModalAtualizacao");
        modalAtualizacao.style.display = "none";

        // Recarregar a lista de pessoas
        
    }

    // Função para fechar o modal de atualização
    var modalAtualizacao = document.getElementById("meuModalAtualizacao");
    var spanAtualizacao = document.getElementById("fecharModalAtualizacaoBtn");

    spanAtualizacao.onclick = function() {
        modalAtualizacao.style.display = "none";
    }

    // Função para fechar o modal de atualização se clicar fora dela
    window.onclick = function(event) {
        if (event.target == modalAtualizacao) {
            modalAtualizacao.style.display = "none";
        }
    }

    // Função para apagar uma pessoa
    function apagar(codpac) {
        var r = confirm("Você confirma que deseja apagar os dados?");
        if (r == true) {
            const xhttp = new XMLHttpRequest();
            xhttp.open("POST", "contrPaciente.php?Apagar", true);
            xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            var data = "codpac=" + encodeURIComponent(codmed);
            xhttp.send(data);

            xhttp.onload = function() {
                document.getElementById("resultadoacao").innerHTML = this.responseText;
                consultar();
            }
        } else {
            document.getElementById("resultadoacao").innerHTML = "Saindo...";
            consultar();
        }

        consultar();
    }
</script>
</body>
</html>
