<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apagar Registos</title>
</head>
<body>
    
    <form action="" method="post">
    
        Nome a apagar: <input type="text" name="apagar">
        <input type="submit" value="Apagar">

    </form>

    <?php

        $nome_servidor = "localhost";
        $utilizador = "root";
        $password = "";
        $db = "bd_login";

        $ligacao = mysqli_connect($nome_servidor, $utilizador, $password, $db);

        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $apagar = $_POST["apagar"];

            $existe = 
                "SELECT *
                FROM loginform
                WHERE user = '{$apagar}';";

            $faz_existe = mysqli_query($ligacao, $existe);
            $ja_existe = mysqli_num_rows($faz_existe);

            //se existir devolve um número maior que 0, ou seja um valor truthy
            if ($ja_existe)
            {
                $apaga = "DELETE FROM loginform WHERE user = '{$apagar}'";
                $faz_apaga = mysqli_query($ligacao, $apaga);
                echo "User apagado com sucesso";
            }
            else
            {
                echo "User não existe";
            }          
        }

        mysqli_close($ligacao);
    ?>

</body>
</html>