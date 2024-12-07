<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Hospitalar</title>
    <style>
        /* Definindo o layout de container */
        .container {
            display: flex;
        }

        /* Sidebar lateral */
        #sidebar {
            width: 250px;
            background-color: #f8f9fa;
            padding: 20px;
        }

        .sidebar-field {
            margin-bottom: 10px;
        }

        .sidebar-item {
            display: block;
            padding: 10px;
            background-color: #e9ecef;
            text-decoration: none;
            color: black;
            border-radius: 5px;
        }

        .sidebar-item:hover {
            background-color: #007bff;
        }

        
    </style>
</head>
<body>
    <div class="container">
        <!-- Menu Lateral -->
        <div id="sidebar">
            <div class="sidebar-field">
                <a href="formMed.php" class="sidebar-item text-dark"> Cadastrar Médico
                </a>
            </div>
            <div class="sidebar-field">
                <a href="formPaciente.php" class="sidebar-item text-dark">Cadastrar Paciente
                </a><br>
                <div class="sidebar-field">
                <a href="formPresc.php" class="sidebar-item text-dark">Prescrição Médica
                </a>
            </div>
            </div>
            <div class="sidebar-field">
                <a href="formCon.php" class="sidebar-item text-dark"> Dados da consulta
                </a>
            </div>
        </div>
<div>
	</body>