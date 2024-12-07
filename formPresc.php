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
	
<h2>Prescrição Médica</h2>

<!-- Botão para abrir o modal de cadastro -->
<button id="abrindoModalBtn">Clique para Inserir Dados</button>

<!-- Modal de Cadastro -->
<div id="meuModalCadastro" class="modal">
    <div class="modal-content">
        <span class="close" id="fecharModalCadastroBtn">&times;</span>
        <h5>Prescrições</h5>
        <input id="codpresc" placeholder="Código:"/><br>    
        <input id="medica" placeholder="Medicamento:" /><br>
        <input id="dosag" placeholder="Dosagem:" /><br>
        <input id="instr" placeholder="Instruções:" /><br>  
        <input id="cid" placeholder="CID:" /><br>   
        <button onclick="cadastrar()">Cadastrar</button>
        <p id="resultadoCadastro"></p>
    </div>
</div>

<h2>Prescrições cadastradas</h2>
<div id="resultado">
    <!-- Tabela com os resultados será gerada aqui -->
</div>

<!-- Modal de Atualização -->
<div id="meuModalAtualizacao" class="modal">
    <div class="modal-content">
        <span class="close" id="fecharModalAtualizacaoBtn">&times;</span>
        <h5>Atualização da prescrição</h5>
        <input id="codpresc" placeholder="Código:"/><br>    
        <input id="medica" placeholder="Medicamento:" /><br>
        <input id="dosag" placeholder="Dosagem:" /><br>
        <input id="instr" placeholder="Instruções:" /><br>  
        <input id="cid" placeholder="CID:" /><br>     
        <button onclick="salvarAtualizacao()">Atualizar</button>
        <p id="resultadoAtualizacao"></p>
    </div>
</div>

<script>
    // Função para consultar e exibir os dados cadastrados
    function consultar() {
        const xhttp = new XMLHttpRequest();
        xhttp.open("GET", "contrPresc.php?Consultar");
        xhttp.send();

        xhttp.onload = function() {
            var resposta = JSON.parse(this.responseText);
            var organizar = "<table><thead><tr><th>Código</th><th>Medicamento</th><th>Dosagem</th><th>Instruções</th><th>CID</th></thead><tbody>";
            for (var i = 0; i < resposta.length; i++) {
                organizar += "<tr><td>" + resposta[i].codpresc + "</td>" +
                    "<td>" + resposta[i].medica + "</td>" +
                    "<td>" + resposta[i].dosag + "</td>" +
                    "<td>" + resposta[i].instr + "</td>" +
                    "<td>" + resposta[i].cid + "</td>" +
                    
                    
                    "<td>" +
                    "<button class='action-button' onclick='atualizar(" + resposta[i].codpresc + ")'>Atualizar</button>" +
                    "<button class='delete-button' onclick='apagar(" + resposta[i].codpresc + ")'>Apagar</button>" +
                    "</td></tr>";
            }
            organizar += "</tbody></table>";
            document.getElementById('resultado').innerHTML = organizar;
        }
    }

    // Função para cadastrar uma nova pessoa
    function cadastrar() {
        var codpresc = document.getElementById("codpresc").value;
        var medica = document.getElementById("medica").value;
        var dosag = document.getElementById("dosag").value;
        var instr = document.getElementById("instr").value;
        var cid = document.getElementById("cid").value;
        
        
        const xhttp = new XMLHttpRequest();
        xhttp.open("POST", "contrPresc.php?Incluir", true);
        xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        var data = "codpresc=" + encodeURIComponent(codpresc) +
            "&medica=" + encodeURIComponent(medica) +
            "&dosag=" + encodeURIComponent(dosag) +
            "&instr=" + encodeURIComponent(instr)+
            "&cid=" + encodeURIComponent(cid);

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
    function atualizar(codpresc) {
        // Buscar os dados dessa pessoa
        const xhttp = new XMLHttpRequest();
        xhttp.open("GET", "contrPresc.php?Consultar");
        xhttp.send();

        xhttp.onload = function() {
            var resposta = JSON.parse(this.responseText);
            for (var i = 0; i < resposta.length; i++) {
                if(matricula==resposta[i].matricula){
                    // Preencher os campos do formulário com os dados do boletim
                    document.getElementById("codpresc").value = resposta[i].codpresc; // A matrícula não pode ser alterado
                    document.getElementById("medica").value = resposta[i].medica;
                    document.getElementById("dosag").value = resposta[i].dosag;
                    document.getElementById("instr").value = resposta[i].instr;
                    document.getElementById("cid").value = resposta[i].cid;
                }
            }
            // Exibir o modal de atualização
            var modalAtualizacao = document.getElementById("meuModalAtualizacao");
            modalAtualizacao.style.display = "block";
        };
    }

    // Função para salvar as atualizações
    function salvarAtualizacao() {
        var codpresc = document.getElementById("codpresc").value;
        var medica = document.getElementById("medica").value;
        var dosag = document.getElementById("dosag").value;
        var instr = document.getElementById("instr").value;
        var cid = document.getElementById("cid").value;
        

        const xhttp = new XMLHttpRequest();
        xhttp.open("POST", "contrMed.php?Atualizar", true);
        xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        var data = "codpresc=" + encodeURIComponent(codpresc) +
            "&medica=" + encodeURIComponent(medica) +
            "&dosag=" + encodeURIComponent(dosag) +
            "&instr=" + encodeURIComponent(instr)+
            "&cid=" + encodeURIComponent(cid);

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
    function apagar(codpresc) {
        var r = confirm("Você confirma que deseja apagar os dados?");
        if (r == true) {
            const xhttp = new XMLHttpRequest();
            xhttp.open("POST", "contrPresc.php?Apagar", true);
            xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            var data = "codpresc=" + encodeURIComponent(codmed);
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
