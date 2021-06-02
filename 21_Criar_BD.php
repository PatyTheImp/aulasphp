<?php

$servidor = 'localhost';
$utilizador = 'root';
$pass = '';

$ligacao = mysqli_connect($servidor, $utilizador, $pass);

//Criar uma base de dados via php
$sql = "CREATE DATABASE CriarBD";

if (mysqli_query($ligacao, $sql))
    echo "<p>Base de dados criada com sucesso!</p>";
else
{
    echo "<p>Erro ao criar a base de dados: <i>" . mysqli_error($ligacao) . "</i></p>";
}