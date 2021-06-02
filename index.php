<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Fonts -->   
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <!-- Meu CSS -->
    <link rel="stylesheet" href="css/style.css">
    
    

    <title>Aulas de PHP</title>
</head>

<body>

<h1 class="mb-4">Exercícios de php</h1>


<div class="container d-flex justify-content-center">
    <div class="row d-flex justify-content-center">
    
        <?php
    
        //Array com o nome dos ficheiros php contendo os exercicios
        $exe_names =
        [
            'Texto' => '01_texto',
            'Variáveis' => '02_variaveis',
            'Cálculos' => '03_calculos',
            'Estruturas de Decisão' => '04_estruturas_decisao',
            'Estruturas de Repetição' => '05_estruturas_repicao',
            'Ciclo for' => 'Ex1_for',
            'Rand' => 'Ex2_rand',
            'Mais ciclos for' => 'exe_extra_for1',
            'Ainda mais ciclos for' => 'exe_extra_for2',
            'Ciclos for everywhere' => 'exe_extra_for3',
            'If else' => 'exe_extra_if1',
            'Mais if else' => 'exe_extra_if2',
            'Switch' => 'exe_extra_switch1'
        ];

        $exe_intermedio =
        [
            'Funções' => '07_funcoes_1',
            'Formulário' => '09_forms',
            'Data e Hora' => '3936_ex3_Patricia_Costa',
            'Login sem BD' => '3936_ex4_Patricia_Costa',
            'Calculadora Versão 1' => 'calculadora',
            'Calculadora Versão 2' => 'calculadorav2',
            'Calculadora Versão 3' => 'calculadorav3',
            'Mais um Formulário' => 'ex20_formularios'
        ]
        ?>
    
        <div class="col">
    
            <h3>Básico</h3>
    
            <ul>
                <?php foreach ($exe_names as $titulo => $name):?>
    
                    <li><a href='PHP_Basics/<?=$name?>.php' target='_blank'><?=$titulo?></a></li>
    
                <?php endforeach;?>
            </ul>
        </div>
    
        <div class="col">
    
            <h3>Intermédio</h3>
    
            <ul>
                <?php foreach ($exe_intermedio as $titulo => $name):?>
    
                    <li><a href='PHP_Intermediate/<?=$name?>.php' target='_blank'><?=$titulo?></a></li>
    
                <?php endforeach;?>
            </ul>
        </div>
    
    </div>
</div>

<img class="tuna" src="imagens/cat-walk.gif">

</body>

</html>