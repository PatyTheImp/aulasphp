<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Paytone+One&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <!-- Meu CSS -->
    <link rel="stylesheet" href="css/style-tabela.css">

    <title>Tabelas SQL</title>
</head>
<body>

    <div>
        <h1 class="py-3 gradient-text">Tabelas SQL</h1>
    </div>

    <?php include('escola_DB_connection.php'); ?>

    <div class="container">

        <h3>Tabela dos Alunos</h3>

        <table class="table table-dark table-striped table-hover mb-3">
          <thead>
            <tr>
                <th>Nº de aluno</th>
                <th>Nome do Aluno</th>
                <th>Ano</th>
                <th>Turma</th>
            </tr>
          </thead>

          <tbody>

                <?php

                    $alunoQuery = "SELECT * FROM aluno";
                    $tabela_aluno = mysqli_query($ligacao, $alunoQuery);

                    $num_registos_aluno = mysqli_num_rows($tabela_aluno);

                    if ($num_registos_aluno <= 0)
                        echo "<tr><td colspan='4'>Sem Registos</td></tr>";
                    else
                    {
                        for ($i = 0; $i < $num_registos_aluno; $i++)
                        {
                            $registos_aluno = mysqli_fetch_array($tabela_aluno);
                            echo "<tr><td>" . $registos_aluno["id"] . "</td>";
                            echo "<td>" . $registos_aluno["nome"] . "</td>";
                            echo "<td>" . $registos_aluno["ano"] . "</td>";
                            echo "<td>" . $registos_aluno["turma"] . "</td></tr>";
                        }
                    }
                ?>       
   
          </tbody>
        </table>

            <form action="" method="post" class="form mb-3">
                    <input class="btn btn-danger" type="submit" value="Apagar" name="btn-apagar-aluno">
                    <input class="btn btn-info" type="submit" value="Editar" name="btn-editar-aluno">
                    <input class="btn btn-success" type="submit" value="Inserir" name="btn-inserir-aluno">
            </form>        

        <?php if (isset($_POST['btn-apagar-aluno'])): ?>

                <form action="" method="post" class="row g-3">
                    <div class="col-auto">
                        <select class="form-select mb-2" name="slt-id-apagar">
                        <option selected value="0">Escolha o id do Registo que quer apagar</option>
                        <?php
                            $alunoQuery = "SELECT * FROM aluno";
                            $tabela_aluno = mysqli_query($ligacao, $alunoQuery);
                            $num_registos_aluno = mysqli_num_rows($tabela_aluno);
                            if ($num_registos_aluno <= 0)
                            echo '<option value="1">Sem Registos</option>';
                            else
                            {
                                for ($i = 1; $i <= $num_registos_aluno; $i++)
                                {
                                    $registos_aluno = mysqli_fetch_array($tabela_aluno);
                                    $valor = $registos_aluno["id"];
                                    echo '<option value="' . $valor . '">' . $valor . '</option>';
                                }
                            }
                        ?>
                        </select>
                    </div>

                    <div class="col-auto"><input class="btn btn-light" type="submit" value="Confirmar" name="btn-confirmar-apagar-aluno"></div>
                </form>

        <?php endif; ?>

        <?php
            if (isset($_POST['btn-confirmar-apagar-aluno']))
            {
                $id =  $_POST['slt-id-apagar'];

                if ($id == 0)
                    echo '<p>Selecione um id</p>';
                else
                {
                    $apaga_aluno = "DELETE FROM aluno WHERE id = {$id}";
                    $faz_apaga_aluno = mysqli_query($ligacao, $apaga_aluno);
                    echo '<p>Aluno apagado com sucesso</p>';
                    exit();
                }
            } 
        ?>

        <?php if (isset($_POST['btn-editar-aluno'])): ?>

            <p>O botão editar foi clicado</p>

        <?php endif; ?>

        <?php if (isset($_POST['btn-inserir-aluno'])): ?>

                <form action="" method="post" class="row g-3">
                    <div class="col-auto"><label for="editar-nome-aluno" class="form-label">Nome do Aluno: </label></div>
                    <div class="col-auto"><input type="text" name="editar-nome-aluno" class="form-control"></div>

                    <div class="col-auto">
                        <select class="form-select mb-2" name="slt-ano-inserir">
                        <option selected value="0">Selecione o ano do aluno</option>
                        <?php
                            for ($i = 7; $i <= 12; $i++)
                                echo "<option value='{$i}'>{$i}º ano</option>";
                        ?>
                        </select>
                    </div>

                    <div class="col-auto">
                        <select class="form-select mb-2" name="slt-turma-inserir">
                        <option selected value="0">Selecione a turma do aluno</option>
                        <option value="A">Turma A</option>
                        <option value="B">Turma B</option>
                        <option value="C">Turma C</option>
                        <option value="D">Turma D</option>
                        </select>
                    </div>

                    <div class="col-auto"><input class="btn btn-light" type="submit" value="Confirmar" name="btn-confirmar-inserir-aluno"></div>
                </form>

        <?php endif; ?>

        <?php
            if (isset($_POST['btn-confirmar-inserir-aluno']))
            {
                $nome_do_aluno = $_POST['editar-nome-aluno'];
                $ano = $_POST['slt-ano-inserir'];
                $turma = $_POST['slt-turma-inserir'];

                if (trim($nome_do_aluno) == "" || $ano == 0 || $turma == 0)
                    echo '<p>Há campos por preencher</p>';
                else
                {
                    $insere_aluno = 
                    "INSERT INTO aluno (nome, ano, turma)
                    VALUES ('{$nome_do_aluno}', {$ano}, '{$turma}')";
                    
                    $faz_insere_aluno = mysqli_query($ligacao, $insere_aluno);
                    echo '<p>Aluno inserido com sucesso</p>';
                    exit();
                }
            } 
        ?>

        <h3 class="mt-5">Tabela das Disciplinas</h3>

        <table class="table table-dark table-striped table-hover mb-5">
          <thead>
            <tr>
                <th>Id</th>
                <th>Disciplina</th>
                <th>Professor(a)</th>
            </tr>
          </thead>

          <tbody>

                <?php

                    $disciplinaQuery = "SELECT * FROM disciplina";
                    $tabela_disciplina = mysqli_query($ligacao, $disciplinaQuery);

                    $num_registos_disciplina = mysqli_num_rows($tabela_disciplina);

                    if ($num_registos_disciplina <= 0)
                        echo "<tr><td colspan='4'>Sem Registos</td></tr>";
                    else
                    {
                        for ($i = 0; $i < $num_registos_disciplina; $i++)
                        {
                            $registos_disciplina = mysqli_fetch_array($tabela_disciplina);
                            echo "<tr><td>" . $registos_disciplina["id"] . "</td>";
                            echo "<td>" . $registos_disciplina["nome"] . "</td>";
                            echo "<td>" . $registos_disciplina["professor"] . "</td></tr>";
                        }
                    }
                ?>       
   
          </tbody>
        </table>

        <h3>Tabela das Notas</h3>

        <table class="table table-dark table-striped table-hover mb-5">
          <thead>
            <tr>
                <th>Id</th>
                <th>Nº do Aluno</th>
                <th>Id da Disciplina</th>
                <th>Valores</th>
            </tr>
          </thead>

          <tbody>

                <?php

                    $notaQuery = "SELECT * FROM nota";
                    $tabela_nota = mysqli_query($ligacao, $notaQuery);

                    $num_registos_nota = mysqli_num_rows($tabela_nota);

                    if ($num_registos_nota <= 0)
                        echo "<tr><td colspan='4'>Sem Registos</td></tr>";
                    else
                    {
                        for ($i = 0; $i < $num_registos_nota; $i++)
                        {
                            $registos_nota = mysqli_fetch_array($tabela_nota);
                            echo "<tr><td>" . $registos_nota["id"] . "</td>";
                            echo "<td>" . $registos_nota["id_aluno"] . "</td>";
                            echo "<td>" . $registos_nota["id_disciplina"] . "</td>";
                            echo "<td>" . $registos_nota["valores"] . "</td></tr>";
                        }
                    }
                ?>       
   
          </tbody>
        </table>

    </div><!--container-->

        <hr>

        <div class="container">
            <h2 class="mb-4">Notas de cada aluno</h2>

            <?php
                if ($num_registos_aluno > 0):
                    $alunoQuery = "SELECT * FROM aluno";
                    $tabela_aluno = mysqli_query($ligacao, $alunoQuery);
                    $num_registos_aluno = mysqli_num_rows($tabela_aluno);
                    for ($j = 0; $j < $num_registos_aluno; $j++):
                        $registos_aluno = mysqli_fetch_array($tabela_aluno);
            ?>

            <h4>Notas do/a <?= $registos_aluno["nome"] ?></h4>

            <table class="table table-dark table-striped table-hover mb-5">
                <thead>
                    <tr>
                        <th>Disciplina</th>
                        <th>Nota</th>
                    </tr>
                </thead>
                <tbody>
                        <?php
                            $tabela_nota_indiv = mysqli_query($ligacao,
                                "SELECT d.nome AS disciplina, n.valores AS nota
                                FROM aluno AS a
                                JOIN nota AS n
                                ON a.id = n.id_aluno
                                JOIN disciplina AS d
                                ON d.id = n.id_disciplina
                                WHERE a.id = " . $registos_aluno["id"]
                            );

                            $num_registos_nota_indiv = mysqli_num_rows($tabela_nota_indiv);
                            
                            if ($num_registos_nota_indiv <= 0)
                                echo "<tr><td colspan='4'>Sem Registos</td></tr>";
                            else
                            {
                                for ($i = 0; $i < $num_registos_nota_indiv; $i++)
                                {
                                    $registos_nota_indiv = mysqli_fetch_array($tabela_nota_indiv);
                                    echo "<tr><td>" . $registos_nota_indiv["disciplina"] . "</td>";
                                    echo "<td>" . $registos_nota_indiv["nota"] . "</td></tr>";
                                }
                            }
                        ?>
                </tbody>
            </table>
            <?php
                    endfor;
                endif;

                mysqli_close($ligacao);
            ?>
        </div><!--container-->
    

</body>
</html>