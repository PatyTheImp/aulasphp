<?php

$servidor = 'localhost';
$utilizador = 'root';
$pass = '';
$db = 'criarbd';

$ligacao = mysqli_connect($servidor, $utilizador, $pass);
$baseDados = mysqli_select_db($ligacao, $db);

if (!$ligacao)
    echo "<p>Erro: não foi possivel estabelecer ligação com MySQL</p>";

if (!$baseDados)
    echo "<p>Erro na escolha da BD</p>";

$sqlTabelaDados = 
"CREATE TABLE Dados
(
    id INT(6) AUTO_INCREMENT PRIMARY KEY,
    primeiro_nome VARCHAR(30) NOT NULL,
    apelido VARCHAR(30) NOT NULL,
    email VARCHAR(50),
    data_reg TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

//Para tornar um campa com registos unicos fazer, por exemplo
//email VARCHAR(50) UNIQUE
if (mysqli_query($ligacao, $sqlTabelaDados))
    echo "<p>Tabela criada com sucesso</p>";
else
    echo "<p>Erro</p>";