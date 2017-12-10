<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Dados do usuario</title>
    </head>
    <body>
        <h1>Dados do usuario</h1>
        <?php
        if (isset($_GET['id'])) {
            include_once './BLL/UsuarioBLL.php';

            $usuarioBLL = new UsuarioBLL();
            echo $usuarioBLL->deleteUsuario($_GET['id']);
        }
        ?>
        <br>
    </body>
</html>


