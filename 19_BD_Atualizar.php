<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/bootstrap.css">
    <title>Atualizar</title>
</head>
<body>

    <div class="container">
        
        <form action="" method="post" class="form my-4">

            <h1>Alterar Palavra Pass</h1>
        
            <label for="nome_atual">Nome a alterar a pass:</label> 
            <input type="text" name="nome_atual">
            <label for="nova_pass">Nova pass:</label> 
            <input type="password" name="nova_pass">
            <input type="submit" value="Alterar">
        
        </form>
        
        <?php
            $nome_servidor = "localhost";
            $utilizador = "root";
            $password = "";
            $db = "bd_login";
            $ligacao = new mysqli($nome_servidor, $utilizador, $password, $db);
            //Verifica conecção
            if ($ligacao -> connect_errno)
            {
                echo "A ligação á base de dados falhou: " . $ligacao -> connect_error;
                exit();
            }
            if ($_SERVER["REQUEST_METHOD"] == "POST")
            {
                $nome_atual = $_POST["nome_atual"];
                $nova_pass = $_POST["nova_pass"];
                if (trim($nome_atual) == "" || trim($nova_pass) == "")
                    echo "<p>Preencha os dois campos</p>";
                else
                {
                    $existe =
                        "SELECT *
                        FROM loginform
                        WHERE user = '{$nome_atual}';";
                    $existe = $ligacao->query($existe);
                    if ($existe->num_rows)
                    {
                        $atualizar =
                            "UPDATE loginform SET pass = '{$nova_pass}'
                            WHERE user = '{$nome_atual}'";
                        $faz_atualizar = $ligacao->query($atualizar);
        
                        echo "<p>Password alterada com sucesso</p>";
                    }
                    else
                        echo "<p>Não existe nenhum user com esse nome</p>";
                }
            }
        ?>
        <h3>Tabela dos Utilizadores e Respectivas Passes</h3>
        <table class="table table-secondary table-striped table-hover mb-5">
            <thead>
                <tr>
                    <th>Utilizador</th>
                    <th>Password</th>
                </tr>
            </thead>
            <tbody>
        
            <?php
            $faz_todosUsers = $ligacao->query("SELECT * FROM loginform");
            if ($rows = $faz_todosUsers->num_rows)
            {
                for ($i = 0; $i < $rows; $i++)
                {
                    $registos = $faz_todosUsers->fetch_array();
                    echo "<tr><td>" . $registos["user"] . "</td>";
                    echo "<td>" . $registos["pass"] . "</td></tr>";
                }
            }
            else
                echo "<tr><td colspan='2'>Sem Registos</td></tr>";
            ?>
        
            </tbody>
        </table>
    </div>

    <?php $ligacao->close(); ?>  
</body>
</html>