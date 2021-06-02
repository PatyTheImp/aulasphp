<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar dados</title>
</head>
<body>
    <?php

        // $nome_servidor = "localhost";
        // $utilizador = "root";
        // $palavra_passe = "";
        // $db = "bd_login";

        // $ligacao = mysqli_connect($nome_servidor, $utilizador, $palavra_passe, $db);
        //$base_dados = mysqli_select_db($ligacao, $db);

        include('20_BD_ligacao.php');

        $lista = "SELECT * FROM loginform";
        $faz_lista = mysqli_query($ligacao, $lista);

        $num_registo = mysqli_num_rows($faz_lista);

        if ($num_registo <= 0)
        {
            echo "Não existem registos.<br><br>";
            exit();
        }
        else
        {
            echo "Existem $num_registo registos!<br><br>";

            for ($i = 0; $i < $num_registo; $i++)
            {
                $registos = mysqli_fetch_array($faz_lista);
                echo "Nome: " . $registos["user"] . "<br>";
                echo "Pass: " . $registos["pass"] . "<br>";
            }
            exit();
        }

        

    ?>
</body>
</html>