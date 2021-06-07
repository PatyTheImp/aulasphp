<?php

//Captar dados
$nome = $_GET['nome'];
$idade = $_GET['idade'];

?>

<h3>Captado por URL</h3>
<p>Nome : <?= $nome ?></p>
<p>Idade: <?= $idade ?></p>