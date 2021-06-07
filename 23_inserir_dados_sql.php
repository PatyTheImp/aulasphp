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

$inserir_dados = 
"INSERT INTO dados (primeiro_nome, apelido, email)
 VALUES ('Patrícia', 'Costa', 'paty@gmail.com'),
 ('Sara', 'Pereira', 'sarinhaa@gamil.com'),
 ('Lucas', 'Amaro', 'lunha@hotmail.com'),
 ('Maria', 'Madalena', 'maam@sapo.pt')";

if (mysqli_query($ligacao, $inserir_dados))
    echo "<p>Sucesso</p>";
else
    echo "<p>Fracasso: " . mysqli_error($ligacao) . "</p>";