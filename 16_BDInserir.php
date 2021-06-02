<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserir na BD</title>
</head>
<body>
    <h1>Inserir Dados</h1>
    <form action="" method="post">
    
        Nome: <input type="text" name="nome">
        <br><br>
        Pass: <input type="password" name="pass">
        <br><br>
        <input type="submit" value="Enviar">
        <br><br>
    
    </form>

    <?php

        $nome_servidor = "localhost";
        $utilizador = "root";
        $password = "";
        $db = "bd_login";

        $ligacao = mysqli_connect($nome_servidor, $utilizador, $password, $db);

        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $nome = $_POST["nome"];
            $pass = $_POST["pass"];

            //Verificação de existencia de user na base de dados
            $existe = 
                "SELECT *
                FROM loginform
                WHERE user = '{$nome}';";

            $faz_existe = mysqli_query($ligacao, $existe);
            $ja_existe = mysqli_num_rows($faz_existe);

            //se existir devolve um número maior que 0, ou seja um valor truthy
            if ($ja_existe)
                echo "Esse user já existe!";
            else
            {
                $inserir_user = 
                    "INSERT INTO loginform (user, pass)
                    VALUES ('{$nome}', '{$pass}');";

                $faz_insere = mysqli_query($ligacao, $inserir_user);
                echo "User inserido com sucesso!";
            }
        }

        mysqli_close($ligacao);

    ?>

</body>
</html>