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

        <form action="" method="post" class="form mb-3">
            <input class="btn btn-danger" type="submit" value="Apagar" name="btn-apagar-aluno">
            <input class="btn btn-info text-light" type="submit" value="Editar" name="btn-editar-aluno">
            <input class="btn btn-success" type="submit" value="Inserir" name="btn-inserir-aluno">
        </form>

        <!-- Apagar aluno -->
        <?php if (isset($_POST['btn-apagar-aluno'])) : ?>
            <h4>Apagar Aluno</h4>

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
                        else {
                            for ($i = 1; $i <= $num_registos_aluno; $i++) {
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

        <!-- Confirmar apagar aluno -->
        <?php
        if (isset($_POST['btn-confirmar-apagar-aluno'])) {
            $id =  $_POST['slt-id-apagar'];

            if ($id == 0)
                echo '<p>Selecione um id</p>';
            else {
                $apaga_aluno = "DELETE FROM aluno WHERE id = {$id}";
                $faz_apaga_aluno = mysqli_query($ligacao, $apaga_aluno);
                echo '<p>Aluno apagado com sucesso</p>';
            }
        }
        ?>

        <!-- Editar aluno -->
        <?php if (isset($_POST['btn-editar-aluno'])) : ?>
            <h4>Editar Aluno</h4>

            <form action="" method="post" class="row g-3">
                <div class="col-auto">
                    <select class="form-select mb-2" name="slt-id-editar" id="slt-id-editar" onchange="mostraAlunoPorId()">
                        <option selected value="0">Id</option>
                        <?php
                        $alunoQuery = "SELECT * FROM aluno";
                        $tabela_aluno = mysqli_query($ligacao, $alunoQuery);
                        $num_registos_aluno = mysqli_num_rows($tabela_aluno);
                        if ($num_registos_aluno <= 0)
                            echo '<option value="1">Sem Registos</option>';
                        else {
                            for ($i = 1; $i <= $num_registos_aluno; $i++) {
                                $registos_aluno = mysqli_fetch_array($tabela_aluno);
                                $valor = $registos_aluno["id"];
                                echo '<option value="' . $valor . '">' . $valor . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="col-auto"><label for="editar-nome-aluno" class="form-label">Nome do Aluno: </label></div>
                <div class="col-auto"><input type="text" name="editar-nome-aluno" class="form-control" id="editar-nome-aluno"></div>

                <div class="col-auto">
                    <select class="form-select mb-2" name="slt-ano-editar" id="slt-ano-editar">
                        <option selected value="0">Selecione o ano do aluno</option>
                        <?php
                        for ($i = 7; $i <= 12; $i++)
                            echo "<option value='{$i}'>{$i}º ano</option>";
                        ?>
                    </select>
                </div>

                <div class="col-auto">
                    <select class="form-select mb-2" name="slt-turma-editar" id="slt-turma-editar">
                        <option selected value="0">Selecione a turma do aluno</option>
                        <option value="A">Turma A</option>
                        <option value="B">Turma B</option>
                        <option value="C">Turma C</option>
                        <option value="D">Turma D</option>
                    </select>
                </div>

                <div class="col-auto"><input class="btn btn-light" type="submit" value="Confirmar" name="btn-confirmar-editar-aluno"></div>
            </form>

        <?php endif; ?>

        <!-- Confirmar editar aluno -->
        <?php

        if (isset($_POST['btn-confirmar-editar-aluno'])) {
            if ($_POST["slt-id-editar"] == 0)
                echo '<p>Escolha o id do aluno que quer editar</p>';
            else {
                $id = $_POST["slt-id-editar"];
                $nome_do_aluno = $_POST['editar-nome-aluno'];
                $ano = $_POST['slt-ano-editar'];
                $turma = $_POST['slt-turma-editar'];

                if (trim($nome_do_aluno) == "" || $ano == 0 || $turma == 0)
                    echo '<p>Há campos por preencher</p>';
                else {
                    $edita_aluno =
                        "UPDATE aluno
                        SET nome = '{$nome_do_aluno}',
                            ano = {$ano},
                            turma = '{$turma}'
                        WHERE id = {$id}";

                    $faz_edita_aluno = mysqli_query($ligacao, $edita_aluno);

                    if ($faz_edita_aluno)
                        echo '<p>Aluno editado com sucesso</p>';
                    else
                        echo '<p>Algo correu mal</p>';
                }
            }
        }
        ?>

        <!-- Inserir aluno -->
        <?php if (isset($_POST['btn-inserir-aluno'])) : ?>
            <h4>Inserir Aluno</h4>

            <form action="" method="post" class="row g-3">
                <div class="col-auto"><label for="inserir-nome-aluno" class="form-label">Nome do Aluno: </label></div>
                <div class="col-auto"><input type="text" name="inserir-nome-aluno" class="form-control"></div>

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

        <!-- Confirmar inserir aluno-->
        <?php
        if (isset($_POST['btn-confirmar-inserir-aluno'])) {
            $nome_do_aluno = $_POST['inserir-nome-aluno'];
            $ano = $_POST['slt-ano-inserir'];
            $turma = $_POST['slt-turma-inserir'];

            if (trim($nome_do_aluno) == "" || $ano == 0 || $turma == 0)
                echo '<p>Há campos por preencher</p>';
            else {
                $insere_aluno =
                    "INSERT INTO aluno (nome, ano, turma)
                    VALUES ('{$nome_do_aluno}', {$ano}, '{$turma}')";

                $faz_insere_aluno = mysqli_query($ligacao, $insere_aluno);
                echo '<p>Aluno inserido com sucesso</p>';
            }
        }
        ?>

        <!-- Tabela dos alunos -->
        <table class="table table-dark table-striped table-hover my-3">
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
                else {
                    for ($i = 0; $i < $num_registos_aluno; $i++) {
                        $registos_aluno = mysqli_fetch_array($tabela_aluno);
                        echo "<tr><td class='idAlunos'>" . $registos_aluno["id"] . "</td>";
                        echo "<td class='nomeAlunos'>" . $registos_aluno["nome"] . "</td>";
                        echo "<td class='anoAlunos'>" . $registos_aluno["ano"] . "</td>";
                        echo "<td class='turmaAlunos'>" . $registos_aluno["turma"] . "</td></tr>";
                    }
                }
                ?>

            </tbody>
        </table>

        <h3 class="mt-5">Tabela das Disciplinas</h3>

            <button class="btn btn-danger" onclick="apagarDisciplinaClick()">Apagar</button>
            <button class="btn btn-info text-light" onclick="editarDisciplinaClick()">Editar</button>
            <button class="btn btn-success" onclick="inserirDisciplinaClick()">Inserir</button>

        <!-- Confirmar apagar disciplina -->
        <?php
        if (isset($_POST['btn-confirmar-apagar-disciplina'])) 
        {
            $id = $_POST["slt-id-disciplina-apagar"];

            if ($id == 0)
                echo '<p>Selecione um id</p>';
            else 
            {
                $apaga_disciplina = "DELETE FROM disciplina WHERE id = {$id}";
                $faz_apaga_disciplina = mysqli_query($ligacao, $apaga_disciplina);
                echo '<p>Disciplina apagada com sucesso</p>';
            }
        }
        ?>

        <!-- Confirmar editar disciplina -->
        <?php

        if (isset($_POST['btn-confirmar-editar-disciplina'])) 
        {
            if ($_POST["slt-id-disciplina-editar"] == 0)
                echo '<p>Escolha o id da disciplina que quer editar</p>';
            else 
            {
                $id = $_POST["slt-id-disciplina-editar"];
                $disciplina = $_POST['editar-nome-disciplina'];
                $professor = $_POST['editar-professor'];

                if (trim($disciplina) == "" || trim($professor) == "")
                    echo '<p>Há campos por preencher</p>';
                else 
                {
                    $edita_disciplina =
                        "UPDATE disciplina
                        SET nome = '{$disciplina}',
                        professor = '{$professor}'
                        WHERE id = {$id}";

                    $faz_edita_disciplina = mysqli_query($ligacao, $edita_disciplina);

                    if ($faz_edita_disciplina)
                        echo '<p>Disciplina editada com sucesso</p>';
                    else
                        echo '<p>Algo correu mal</p>';
                }
            }
        }
        ?>

        <!-- Confirmar inserir disciplina -->
        <?php
        if (isset($_POST['btn-confirmar-inserir-disciplina'])) 
        {
            $disciplina = $_POST['inserir-nome-disciplina'];
            $professor = $_POST['inserir-professor'];

            if (trim($disciplina) == "" || trim($professor) == "")
                echo '<p>Há campos por preencher</p>';
            else 
            {
                $insere_disciplina =
                    "INSERT INTO disciplina (nome, professor)
                    VALUES ('{$disciplina}', '{$professor}')";

                $faz_insere_disciplina = mysqli_query($ligacao, $insere_disciplina);
                echo '<p>Disciplina inserida com sucesso</p>';
            }
        }
        ?>

        <!-- Apagar disciplina -->
            <div id="apagar-disciplina-div" style="display: none;">
                <h4>Apagar Disciplina</h4>
                <form action="" method="post" class="row g-3">
                    <div class="col-auto">
                        <select class="form-select mb-2" name="slt-id-disciplina-apagar">
                            <option selected value="0">Escolha o id do Registo que quer apagar</option>
                            <?php
                            $disciplinaQuery = "SELECT * FROM disciplina";
                            $tabela_disciplina = mysqli_query($ligacao, $disciplinaQuery);
                            $num_registos_disciplina = mysqli_num_rows($tabela_disciplina);
                            if ($num_registos_disciplina <= 0)
                                echo '<option value="1">Sem Registos</option>';
                            else
                            {
                                for ($i = 1; $i <= $num_registos_disciplina; $i++)
                                {
                                    $registos_disciplina = mysqli_fetch_array($tabela_disciplina);
                                    $valor = $registos_disciplina["id"];
                                    echo '<option value="' . $valor . '">' . $valor . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-auto"><input class="btn btn-light" type="submit" value="Confirmar" name="btn-confirmar-apagar-disciplina"></div>
                </form>
            </div>

        <!-- Editar disciplina -->
        <div id="editar-disciplina-div" style="display: none;">
            <h4>Editar Disciplina</h4>

            <form action="" method="post" class="row g-3">
                <div class="col-auto">
                    <select class="form-select mb-2" name="slt-id-disciplina-editar" id="slt-id-disciplina-editar" onchange="mostraDisciplinaPorId()">
                        <option selected value="0">Id</option>
                        <?php
                        $disciplinaQuery = "SELECT * FROM disciplina";
                        $tabela_disciplina = mysqli_query($ligacao, $disciplinaQuery);
                        $num_registos_disciplina = mysqli_num_rows($tabela_disciplina);
                        if ($num_registos_disciplina <= 0)
                            echo '<option value="1">Sem Registos</option>';
                        else
                        {
                            for ($i = 1; $i <= $num_registos_disciplina; $i++)
                            {
                                $registos_disciplina = mysqli_fetch_array($tabela_disciplina);
                                $valor = $registos_disciplina["id"];
                                echo '<option value="' . $valor . '">' . $valor . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="col-auto"><label for="editar-nome-disciplina" class="form-label">Disciplina: </label></div>
                <div class="col-auto"><input type="text" name="editar-nome-disciplina" class="form-control" id="editar-nome-disciplina"></div>

                <div class="col-auto"><label for="editar-professor" class="form-label">Nome do Professor: </label></div>
                <div class="col-auto"><input type="text" name="editar-professor" class="form-control" id="editar-professor"></div>

                <div class="col-auto"><input class="btn btn-light" type="submit" value="Confirmar" name="btn-confirmar-editar-disciplina"></div>
            </form>
        </div>

        <!-- Inserir disciplina -->
        <div id="inserir-disciplina-div" style="display: none;">
        
            <h4>Inserir Disciplina</h4>

            <form action="" method="post" class="row g-3">

                <div class="col-auto"><label for="inserir-nome-disciplina" class="form-label">Disciplina: </label></div>
                <div class="col-auto"><input type="text" name="inserir-nome-disciplina" class="form-control" id="inserir-nome-disciplina"></div>

                <div class="col-auto"><label for="inserir-professor" class="form-label">Nome do Professor: </label></div>
                <div class="col-auto"><input type="text" name="inserir-professor" class="form-control" id="inserir-professor"></div>

                <div class="col-auto"><input class="btn btn-light" type="submit" value="Confirmar" name="btn-confirmar-inserir-disciplina"></div>
            </form>
        
        </div>

        <!-- Tabela das disciplinas -->
        <table class="table table-dark table-striped table-hover mb-5 mt-3">
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
                        echo "<tr><td class='idDisciplina'>" . $registos_disciplina["id"] . "</td>";
                        echo "<td class='nomeDisciplina'>" . $registos_disciplina["nome"] . "</td>";
                        echo "<td class='professor'>" . $registos_disciplina["professor"] . "</td></tr>";
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
                else {
                    for ($i = 0; $i < $num_registos_nota; $i++) {
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

    </div>
    <!--container-->

    <hr>

    <div class="container">
        <h2 class="mb-4">Notas de cada aluno</h2>

        <?php
        if ($num_registos_aluno > 0) :
            $alunoQuery = "SELECT * FROM aluno";
            $tabela_aluno = mysqli_query($ligacao, $alunoQuery);
            $num_registos_aluno = mysqli_num_rows($tabela_aluno);
            for ($j = 0; $j < $num_registos_aluno; $j++) :
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
                        $tabela_nota_indiv = mysqli_query(
                            $ligacao,
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
                        else {
                            for ($i = 0; $i < $num_registos_nota_indiv; $i++) {
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
    </div>
    <!--container-->

    <script src="main.js"></script>
</body>

</html>