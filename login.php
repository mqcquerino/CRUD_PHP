<?php
session_start();
if (isset($_GET['sair'])) {
    session_destroy();
}
if (isset($_SESSION['login']) && $_SESSION['login'] === 1) {
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
    </head>
    <body>
        <h1>Login</h1>
        <form action="logarUsuario.php" method="post">
            <label>Email</label> <br> 
            <input type="text" name="email"> <br> <br>
            <label>Senha</label> <br> 
            <input type="text" name="senha"> <br> <br>
            <input type="submit" value="Entrar">
        </form>

        <br>
        <a href="cadastro.php">Novo usuario</a>
    </body>
</html>
