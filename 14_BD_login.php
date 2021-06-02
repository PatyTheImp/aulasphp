<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login com BD</title>
</head>
<body>
    <form action="" method="post">
        <label for="nome">Nome: </label>
        <input type="text" name="nome" id="nome">
        <br><br>
        <label for="pass">Pass: </label>
        <input type="password" name="pass" id="pass">
        <br><br>
        <input type="submit" value="entrar">
    </form>

    <?php

        $nome_servidor = "localhost";
        $utilizador = "root";
        $palavra_passe = "";
        $db = "bd_login";

        $ligacao = mysqli_connect($nome_servidor, $utilizador, $palavra_passe);
        $base_dados = mysqli_select_db($ligacao, $db);

        if (isset($_POST["nome"], $_POST["pass"]))
        {
            $user_name = $_POST["nome"];
            $password = $_POST["pass"];

            $sql = mysqli_query($ligacao, 
                "SELECT * 
                FROM loginform 
                WHERE user = '{$user_name}' AND pass = '{$password}'");

            if (mysqli_num_rows($sql) == 1)
            {
                echo "Login com sucesso!";
                exit();
            }
            else
            {
                echo "Dados de login incorretos!";
                exit();
            }

            mysqli_close($ligacao);
        }

    ?>
</body>
</html>