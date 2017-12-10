<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Dados do usuario</title>
    </head>
    <body>
        <h1>Dados do usuario</h1>
        <?php
        if (isset($_POST['id']) && isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['descricao']) && isset($_POST['senha'])) {
            include_once './BLL/UsuarioBLL.php';

            $usuarioBLL = new UsuarioBLL();
            $usuario = new Usuario();
            $usuario->setNome($_POST['nome']);
            $usuario->setEmail($_POST['email']);
            $usuario->setDescricao($_POST['descricao']);
            $usuario->setSenha($_POST['senha']);
            $usuario->setCodigo($_POST['id']);

            echo $usuarioBLL->alterarDados($usuario);
        }
        ?> 
        <a href="cadastro.php">Cadastrar novo usuario</a>
    </body>
</html>


