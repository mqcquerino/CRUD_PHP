<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Dados do usuario</title>
    </head>
    <body>
        <?php
        if (isset($_POST['email']) && $_POST['senha']) {
            include_once './BLL/UsuarioBLL.php';
            include_once './Entidade/Usuario.php';

            $usuarioBLL = new UsuarioBLL();
            $usuario = new Usuario();

            $usuario->setEmail($_POST['email']);
            $usuario->setSenha($_POST['senha']);

            echo $usuarioBLL->logarUsuario($usuario);
        } else {
            echo "<p>Preencha todos os campos! </p>";
            echo "<a href='login.php'>Voltar </a>";
        }
        ?>
        <br>        
    </body>
</html>


