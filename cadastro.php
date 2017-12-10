<html>
    <body>
        <header>
            <h1>Cadastro</h1>
        </header>
        <form action="cadastrarusuario.php" method="post" enctype="multipart/form-data">
            <label>Nome</label> <br>
            <input type="text" name="nome"> <br><br>
            <label>Descricao</label> <br>
            <input type="text" name="descricao"> <br><br>
            <label>Email</label> <br>
            <input type="text" name="email"> <br><br>
            <label>Senha</label> <br>
            <input type="text" name="senha"> <br><br>
            <label for="imagem">Anexo</label> <br>
            <input type="file" name="anexo"> <br><br>
            <input type="submit" value="Insert">                
        </form>            
        <a href="index.php">Voltar</a>
    </body>
</html>

