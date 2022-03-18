<?php
include_once './conexao.php';

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

$query_usuario = "SELECT id, nome, email FROM usuarios WHERE id = $id LIMIT 1";
$result_usuario = $conn->prepare($query_usuario);
$result_usuario->execute();

if (($result_usuario) AND ($result_usuario->rowCount() != 0)) {
    $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
    
} else {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Editar</title>
    </head>
    <body>
        <a href="index.php">Listar</a><br>
        <a href="cadastrar.php">Cadastrar</a><br>
        <h1>Editar</h1>
        <?php
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        
        
        if(!empty($dados['EditUsuario'])){
            $empty_input = false;
            $dados = array_map('trim', $dados);
            if(in_array("", $dados)){
                echo"<p style='color:#f00;'>Erro:Necessário preencher todos os campos!</p>";
            } 
            if(!$empty_input){
                $query_up_usuario = "UPDATE usuarios SET nome=:nome, email=:email WHERE id=:id";
                $edit_usuario = $conn->prepare($query_up_usuario);
                $edit_usuario->bindParam(':nome', $dados['nome']);
                $edit_usuario->bindParam(':email', $dados['email']);
                $edit_usuario->bindParam(':id', $id);
                if($edit_usuario->execute()){
                    header("Location: index.php");
                }else{
                    echo"<p style='color:red;'Erro: Usuário não editado</p>";
                }
                
            }
           
        }
        ?>

        <form id="edit_usuario" method="POST" action="">
            <label>Nome: </label>
            <input type="text" name="nome" id="nome" placeholder="Nome completo" value="<?php
            if(isset($dados['nome'])){
                echo $dados['nome'];
            }elseif (isset($row_usuario['nome'])) {
                echo $row_usuario['nome'];
        }
        ?>"required ><br><br>

            <label>E-mail: </label>
            <input type="email" name="email" id="email" placeholder="Digite seu e-mail" value="<?php
            if(isset($dados['email'])){
                echo $dados['email'];
            } elseif (isset($row_usuario['email'])) {
                echo $row_usuario['email'];
            }
        ?>"required ><br><br>


            <input type="submit" value="Salvar" name="EditUsuario">


        </form>
    </body>
</html>
