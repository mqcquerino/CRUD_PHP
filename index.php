<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['login'] !== 1) {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Listar usuarios</title>
    </head>
    <body>
        <h1>Listagem de usuarios</h1>
        <p style="font-weight: bold">Você está logado como: <?php echo $_SESSION['nome'] ?></p> 
        <p>Selecione o usuario clicando em seu código</p>
        <?php
        include_once './BLL/UsuarioBLL.php';

        $usuarioBLL = new UsuarioBLL();
        echo $usuarioBLL->selectUsuarios();
        ?>
        <br><br>
        <a href="cadastro.php">Cadastrar novo usuario</a> <br><br>
        <a href="login.php?sair=1">Deslogar</a>
    </body>
</html>
