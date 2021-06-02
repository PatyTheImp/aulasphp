<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesquisar</title>
</head>
<body>
    <form action="" method="post">
    
        Nome: <input type="text" name="nome"> <input type="submit" value="Pesquisar">

    </form>
    <br>

    <?php

        $nome_servidor = "localhost";
        $utilizador = "root";
        $password = "";
        $db = "bd_login";

        $ligacao = mysqli_connect($nome_servidor, $utilizador, $password, $db);

        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $nome = $_POST["nome"];
            $procurar = 
                "SELECT *
                FROM loginform
                WHERE user LIKE '%{$nome}%'";
            $faz_procurar = mysqli_query($ligacao, $procurar);
            $num_registos = mysqli_num_rows($faz_procurar);

            if ($num_registos == 0)
                echo "Não foram encontrados registos com esse nome!";
            else
                echo "Foram encontrados {$num_registos} registos com esse nome";
        }

    ?>

    <h3>Listagem de dados:</h3>

    <?php

        for ($i = 0; $i < $num_registos; $i++)
        {
            $registos = mysqli_fetch_array($faz_procurar);
            echo "<p><b>Utilizador:</b> {$registos['user']} <b>Pass:</b> {$registos['pass']}</p>";
        }

        mysqli_close($ligacao);

    ?>

</body>
</html>