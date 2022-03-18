<?php
session_start();
ob_start();
include_once './conexao.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Listar</title>
    </head>
    <body>
        <a href="index.php">Listar</a><br>
        <a href="cadastrar.php">Cadastrar</a><br>
        <h1>Listar</h1>
        
        <?php
        
        $query_usuarios = "SELECT id, nome, email FROM usuarios";
        $result_usuarios = $conn->prepare($query_usuarios);
        $result_usuarios->execute();
        
        if(($result_usuarios) AND ($result_usuarios->rowCount()!= 0)){
            while($row_usuario = $result_usuarios->fetch(PDO::FETCH_ASSOC)){
                extract($row_usuario);
                echo "$nome<br>";
                echo "$email<br>";
                echo "<a href='editar.php?id=$id'>Editar</a><br>"; 
                echo "<a href='apagar.php?id=$id'>Apagar</a><br>";
                echo "<hr>";
            }
            
        }else{
            echo"<p style ='color: red'>Erro: Nenhum usuário encontrado";
        }
        
        ?>
        
        </form>
    </body>
</html>
