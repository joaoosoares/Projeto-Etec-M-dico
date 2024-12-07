CREATE DATABASE hospital;
USE hospital;

CREATE TABLE medico (
    codmed INT PRIMARY KEY,
    nomemed VARCHAR(50),
    espec VARCHAR(30),
    crm INT
);

CREATE TABLE paciente (
    codpac INT PRIMARY KEY,
    nomepac VARCHAR(50),
    nasc DATE,
    tel CHAR(11),
    cpf CHAR(11)
);

CREATE TABLE prescricao (
    codpresc INT PRIMARY KEY,
    medica VARCHAR(20),
    dosag VARCHAR(30),
    instr VARCHAR(60),
    cid VARCHAR(7)
);

CREATE TABLE consulta (
    codcon INT PRIMARY KEY,
    datacons DATE,
    hora TIME,
    sintomas VARCHAR(90),
    paciente INT,
    medico INT,
    prescricao INT,
    FOREIGN KEY (paciente) REFERENCES paciente(codpac),
    FOREIGN KEY (medico) REFERENCES medico(codmed),
    FOREIGN KEY (prescricao) REFERENCES prescricao(codpresc)
);


INSERT INTO medico VALUES (1, 'Joao', 'clínico geral', 123);
INSERT INTO paciente VALUES (1, 'Jose', '1980-01-01', '11965654545', '21632132132');
INSERT INTO prescricao VALUES (1, 'paracetamol', '20mg', 'aplicar...', 'A15');
INSERT INTO consulta VALUES (1, '2024-11-26', '21:20:00', 'Gripe', 1, 1, 1);


SELECT * FROM consulta
LEFT JOIN medico ON consulta.medico = medico.codmed
LEFT JOIN paciente ON consulta.paciente = paciente.codpac
LEFT JOIN prescricao ON consulta.prescricao = prescricao.codpresc;

SELECT * FROM consulta;

SELECT * FROM prescricao;
