<?php
include_once './conexao.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cadastrar</title>
    </head>
    <body>
        <a href="index.php">Listar</a><br>
        <a href="cadastrar.php">Cadastrar</a><br>
        <h1>Cadastrar</h1>
        <?php
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (!empty($dados['CadUsuario'])) {

            
            $empty_input = false;

            $dados = array_map('trim', $dados);
            if (in_array("", $dados)) {
                $empty_input = true;
                echo "<p style='color:red;'>Necessário preencher todos os campos<br/>";
            }

            if (!$empty_input) {
                $query_usuario = "INSERT INTO usuarios (nome, email) VALUES (:nome,:email)";
                $cad_usuario = $conn->prepare($query_usuario);
                $cad_usuario->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
                $cad_usuario->bindParam(':email', $dados['email'], PDO::PARAM_STR);
                $cad_usuario->execute();
                if ($cad_usuario->rowCount()) {
                    echo "<p style='color:green;'> Usuário cadastrado com sucesso!<br/>";
                } else {
                    echo "<p style='color:red;'>Usuário não cadastrado<br/>";
                }
            }
        }
        ?>

        <form name ="cad-usuario" method="POST" action="">
            <label> Nome: </label>
            <input type="text" name ="nome" id="nome" placeholder="Nome completo"><br/><br/>

            <label> E-mail: </label>
            <input type="email" name="email" id="email" placeholder="Digite seu e-mail"><br/><br/>

            <input type="Submit" value ="Cadastrar" name="CadUsuario">
        </form>
    </body>
</html>
