<?php

$servidor = 'localhost';
$utilizador = 'root';
$pass = '';
$db = 'bd_login';

$ligacao = mysqli_connect($servidor, $utilizador, $pass);
$baseDados = mysqli_select_db($ligacao, $db);

if (!$ligacao)
    echo "<p>Erro: não foi possivel estabelecer ligação com MySQL</p>";

if (!$baseDados)
    echo "<p>Erro na escolha da BD</p>";

