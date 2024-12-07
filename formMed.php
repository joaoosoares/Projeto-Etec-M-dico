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
	
<h2>Cadastro de Médico</h2>

<!-- Botão para abrir o modal de cadastro -->
<button id="abrindoModalBtn">Clique para Inserir Dados</button>

<!-- Modal de Cadastro -->
<div id="meuModalCadastro" class="modal">
    <div class="modal-content">
        <span class="close" id="fecharModalCadastroBtn">&times;</span>
        <h5>Cadastro de Pessoa</h5>
        <input id="codmed" placeholder="Código:"/><br>    
        <input id="nomemed" placeholder="Nome:" /><br>
        <input id="espec" placeholder="Especialização:" /><br>  
        <button onclick="cadastrar()">Cadastrar</button>
        <p id="resultadoCadastro"></p>
    </div>
</div>

<h2>Médicos cadastrados</h2>
<div id="resultado">
    <!-- Tabela com os resultados será gerada aqui -->
</div>

<!-- Modal de Atualização -->
<div id="meuModalAtualizacao" class="modal">
    <div class="modal-content">
        <span class="close" id="fecharModalAtualizacaoBtn">&times;</span>
        <h5>Atualização do cadastro</h5>
        <input id="codmed" placeholder="Código:"/><br>    
        <input id="nomemed" placeholder="Nome:" /><br>
        <input id="espec" placeholder="Especialização:" /><br>     
        <button onclick="salvarAtualizacao()">Atualizar</button>
        <p id="resultadoAtualizacao"></p>
    </div>
</div>

<script>
    // Função para consultar e exibir os dados cadastrados
    function consultar() {
        const xhttp = new XMLHttpRequest();
        xhttp.open("GET", "contrMed.php?Consultar");
        xhttp.send();

        xhttp.onload = function() {
            var resposta = JSON.parse(this.responseText);
            var organizar = "<table><thead><tr><th>Código</th><th>Nome</th><th>Especialidade</th><th>CRM</th></tr></thead><tbody>";
            for (var i = 0; i < resposta.length; i++) {
                organizar += "<tr><td>" + resposta[i].codmed + "</td>" +
                    "<td>" + resposta[i].nomemed + "</td>" +
                    "<td>" + resposta[i].espec + "</td>" +
                    "<td>" + resposta[i].crm + "</td>" +
                    
                    
                    "<td>" +
                    "<button class='action-button' onclick='atualizar(" + resposta[i].codmed + ")'>Atualizar</button>" +
                    "<button class='delete-button' onclick='apagar(" + resposta[i].codmed + ")'>Apagar</button>" +
                    "</td></tr>";
            }
            organizar += "</tbody></table>";
            document.getElementById('resultado').innerHTML = organizar;
        }
    }

    // Função para cadastrar uma nova pessoa
    function cadastrar() {
        var codmed = document.getElementById("codmed").value;
        var nomemed = document.getElementById("nomemed").value;
        var espec = document.getElementById("espec").value;
        var crm = document.getElementById("crm").value;
        
        
        const xhttp = new XMLHttpRequest();
        xhttp.open("POST", "contrMed.php?Incluir", true);
        xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        var data = "codmed=" + encodeURIComponent(codmed) +
            "&nomemed=" + encodeURIComponent(nomemed) +
            "&espec=" + encodeURIComponent(espec) +
            "&crm=" + encodeURIComponent(crm);

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
    function atualizar(codmed) {
        // Buscar os dados dessa pessoa
        const xhttp = new XMLHttpRequest();
        xhttp.open("GET", "contrMed.php?Consultar");
        xhttp.send();

        xhttp.onload = function() {
            var resposta = JSON.parse(this.responseText);
            for (var i = 0; i < resposta.length; i++) {
                if(matricula==resposta[i].matricula){
                    // Preencher os campos do formulário com os dados do boletim
                    document.getElementById("codmed").value = resposta[i].codmed; // A matrícula não pode ser alterado
                    document.getElementById("nomemed").value = resposta[i].nomemed;
                    document.getElementById("espec").value = resposta[i].espec;
                    document.getElementById("crm").value = resposta[i].crm;
                }
            }
            // Exibir o modal de atualização
            var modalAtualizacao = document.getElementById("meuModalAtualizacao");
            modalAtualizacao.style.display = "block";
        };
    }

    // Função para salvar as atualizações
    function salvarAtualizacao() {
        var codmed = document.getElementById("codmed").value;
        var nomemed = document.getElementById("nomemed").value;
        var espec = document.getElementById("espec").value;
        var crm = document.getElementById("crm").value;

        const xhttp = new XMLHttpRequest();
        xhttp.open("POST", "contrMed.php?Atualizar", true);
        xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        var data = "codmed=" + encodeURIComponent(codmed) +
            "&nomemed=" + encodeURIComponent(nomemed) +
            "&espec=" + encodeURIComponent(espec) +
            "&crm=" + encodeURIComponent(crm);

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
    function apagar(codmed) {
        var r = confirm("Você confirma que deseja apagar os dados?");
        if (r == true) {
            const xhttp = new XMLHttpRequest();
            xhttp.open("POST", "contrMed.php?Apagar", true);
            xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            var data = "codmed=" + encodeURIComponent(codmed);
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
