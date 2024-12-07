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
	
<h2>Cadastro de Consultas</h2>

<!-- Botão para abrir o modal de cadastro -->
<button id="abrindoModalBtn">Clique para Inserir Dados</button>

<!-- Modal de Cadastro -->
<div id="meuModalCadastro" class="modal">
    <div class="modal-content">
        <span class="close" id="fecharModalCadastroBtn">&times;</span>
        <h5>Gerar Consulta</h5>
        <input id="codcon" placeholder="Código:"/><br>    
        <input  type="datacons" id="data" placeholder="Data:" /><br>
        <input type="time" id="hora" placeholder="Horário:" /><br>
        <input id="sintomas" placeholder="Sintomas:" /><br>  
        <input id="paciente" placeholder="Paciente:" /><br>   
        <input id="medico" placeholder="Médico:" /><br>   
        <input id="prescricao" placeholder="Prescrição:" /><br>   
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
        <h5>Atualização da Consulta</h5>
        <input id="codcon" placeholder="Código:"/><br>    
        <input type="date" id="datacons" placeholder="Data:" /><br>
        <input type="time" id="hora" placeholder="Horário:" /><br>
        <input id="sintomas" placeholder="Sintomas:" /><br>  
        <input id="paciente" placeholder="Paciente:" /><br>   
        <input id="medico" placeholder="Médico:" /><br>   
        <input id="prescricao" placeholder="Prescrição:" /><br>      
        <button onclick="salvarAtualizacao()">Atualizar</button>
        <p id="resultadoAtualizacao"></p>
    </div>
</div>

<script>
    // Função para consultar e exibir os dados cadastrados
    function consultar() {
        const xhttp = new XMLHttpRequest();
        xhttp.open("GET", "contrCon.php?Consultar");
        xhttp.send();

        xhttp.onload = function() {
            var resposta = JSON.parse(this.responseText);
            var organizar = "<table><thead><tr><th>Código</th><th>Data</th><th>Horário</th><th>Sintomas</th><th>Paciente</th><th>Médico</th><th>Prescrição</th></thead><tbody>";
            for (var i = 0; i < resposta.length; i++) {
                organizar += "<tr><td>" + resposta[i].codcon + "</td>" +
                    "<td>" + resposta[i].datacons + "</td>" +
                    "<td>" + resposta[i].hora + "</td>" +
                    "<td>" + resposta[i].sintomas + "</td>" +
                    "<td>" + resposta[i].paciente + "</td>" +
                    "<td>" + resposta[i].medico + "</td>" +
                    "<td>" + resposta[i].prescricao + "</td>" +
                    
                    
                    "<td>" +
                    "<button class='action-button' onclick='atualizar(" + resposta[i].codcon + ")'>Atualizar</button>" +
                    "<button class='delete-button' onclick='apagar(" + resposta[i].codcon + ")'>Apagar</button>" +
                    "</td></tr>";
            }
            organizar += "</tbody></table>";
            document.getElementById('resultado').innerHTML = organizar;
        }
    }

    // Função para cadastrar uma nova pessoa
    function cadastrar() {
        var codcon = document.getElementById("codcon").value;
        var datacons = document.getElementById("datacons").value;
        var hora = document.getElementById("hora").value;
        var sintomas = document.getElementById("sintomas").value;
        var paciente = document.getElementById("paciente").value;
        var medico = document.getElementById("medico").value;
        var prescricao = document.getElementById("prescricao").value;
        
        
        const xhttp = new XMLHttpRequest();
        xhttp.open("POST", "contrCon.php?Incluir", true);
        xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        var data = "codcon=" + encodeURIComponent(codpac) +
            "&datacons=" + encodeURIComponent(nomepac) +
            "&hora=" + encodeURIComponent(nasc) +
            "&sintomas=" + encodeURIComponent(tel)+
            "&paciente=" + encodeURIComponent(cpf)+
            "&medico=" + encodeURIComponent(cpf)+
            "&prescricao=" + encodeURIComponent(cpf)+

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
