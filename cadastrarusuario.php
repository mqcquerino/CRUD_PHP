<html>
    <body>
        <?php
        if (isset($_POST['nome']) && isset($_POST['descricao']) && isset($_POST['email']) && isset($_POST['senha']) && !empty($_POST['email'] && !empty($_POST['senha']))) {
            include_once './BLL/UsuarioBLL.php';
            include_once './Entidade/Usuario.php';

            $usuarioBLL = new UsuarioBLL();

            $usuario = new Usuario();
            $usuario->setNome($_POST['nome']);
            $usuario->setDescricao($_POST['descricao']);
            $usuario->setEmail($_POST['email']);
            $usuario->setSenha($_POST['senha']);

            /* Verifica se foi inserido um anexo pelo usuario */
            if ($_FILES["anexo"]["error"] !== 4) {
                $temporario = $_FILES["anexo"]["tmp_name"];
                $nome = $_FILES["anexo"]["name"];
                /* Atribui uma chave cripitografada a partir do email do usuario ao nome da imagem para associar o anexo ao usuario  */
                $path = md5($usuario->getEmail()) . "_____" . $nome;
                copy($temporario, $path);
                $usuario->setAnexo($path);
            }
            echo $usuarioBLL->inserirUsuario($usuario);
        } 
        else {
            echo "<p>Preencha todos os campos! </p>";
        }
        ?>
        <a href="index.php">Voltar</a>
    </body>
</html>
