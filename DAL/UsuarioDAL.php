<?php

include_once 'IUsuario.php';
include_once 'Config.php';
include_once 'DBConnection.php';

/**
 * @author Marcelo
 */
class UsuarioDAL implements IUsuario {

    public $con = null;

    /* Método construtor chama o método de abertura do banco de dados e atribui a variavel de instancia da classe */
    public function __construct() {
        $this->con = DBConnection::getInstance();
    }

    
    public function insert(Usuario $u) {
        if ($this->con) {
            $cmd = "INSERT INTO tb_usuario (_Nome, _Descricao, _Email, _Senha, _Anexo) VALUES (?, ?, ?, ?, ?)";
            $stm = $this->con->prepare($cmd);
            $stm->bindValue(1, $u->getNome());
            $stm->bindValue(2, $u->getDescricao());
            $stm->bindValue(3, $u->getEmail());
            $stm->bindValue(4, $u->getSenha());
            $stm->bindValue(5, $u->getAnexo());
            try {
                $stm->execute();
                if ($stm->rowCount() > 0) {
                    return SUCESSO;
                } else {
                    return SEM_REGISTROS;
                }
            } catch (PDOException $e) {
                //echo "Erro -> ".$e;
                return ERRO_INSTRUCAO;
            }
        } else {
            return ERRO_DB;
        }
    }

    public function select() {
        if ($this->con) {
            $cmd = "SELECT _Id, _Nome, _Descricao, _Email, _Anexo FROM tb_usuario";
            $stm = $this->con->prepare($cmd);
            try {
                $stm->execute();
                if ($stm->rowCount() > 0) {
                    $array = new ArrayObject();
                    while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
                        $usuario = new Usuario();
                        $usuario->setCodigo($row['_Id']);
                        $usuario->setNome($row['_Nome']);
                        $usuario->setDescricao($row['_Descricao']);
                        $usuario->setEmail($row['_Email']);
                        $usuario->setAnexo($row['_Anexo']);
                        $array->append($usuario);
                    }
                    return $array;
                } else {
                    return SEM_REGISTROS;
                }
            } catch (PDOException $e) {
                //echo "Erro -> ". $e;
                return ERRO_INSTRUCAO;
            }
        } else {
            return ERRO_DB;
        }
    }

    public function selectUsuario($id) {
        if ($this->con) {
            $cmd = "SELECT _Id, _Nome, _Descricao, _Email, _Senha FROM tb_usuario WHERE _Id = (?)";
            $stm = $this->con->prepare($cmd);
            $stm->bindValue(1, $id);
            try {
                $stm->execute();
                if ($stm->rowCount() > 0) {
                    $row = $stm->fetch(PDO::FETCH_ASSOC);
                    $usuario = new Usuario();
                    $usuario->setCodigo($row['_Id']);
                    $usuario->setNome($row['_Nome']);
                    $usuario->setDescricao($row['_Descricao']);
                    $usuario->setEmail($row['_Email']);
                    $usuario->setSenha($row['_Senha']);
                    return $usuario;
                } else {
                    return SEM_REGISTROS;
                }
            } catch (PDOException $e) {
                //echo "Erro -> ". $e;
                return ERRO_INSTRUCAO;
            }
        } else {
            return ERRO_DB;
        }
    }

    public function delete($id) {
        if ($this->con) {
            $cmd = "DELETE FROM tb_usuario WHERE _Id = (?)";
            $stm = $this->con->prepare($cmd);
            $stm->bindValue(1, $id);
            try {
                $stm->execute();
                if ($stm->rowCount() > 0) {
                    return SUCESSO;
                } else {
                    return SEM_REGISTROS;
                }
            } catch (PDOException $e) {
                //echo "Erro -> ". $e;
                return ERRO_INSTRUCAO;
            }
        } else {
            return ERRO_DB;
        }
    }

    public function update(\Usuario $us) {
        if ($this->con) {
            $cmd = "UPDATE tb_usuario SET _Nome = (?), _Descricao = (?), _Email = (?), _Senha = (?) WHERE _Id = (?)";
            $stm = $this->con->prepare($cmd);
            $stm->bindValue(1, $us->getNome());
            $stm->bindValue(2, $us->getDescricao());
            $stm->bindValue(3, $us->getEmail());
            $stm->bindValue(4, $us->getSenha());
            $stm->bindValue(5, $us->getCodigo());
            try{
                $stm->execute();
                if($stm->rowCount() > 0){
                    return SUCESSO;
                }
                else{
                    return SEM_REGISTROS;
                }
            } catch (PDOException $e) {
               //echo "Erro -> ". $e;
                return ERRO_INSTRUCAO;
            }
        } 
        else {
            return ERRO_DB;
        }
    }
    
    public function selectUsuarioEmailSenha(Usuario $u){
         if ($this->con) {
            $cmd = "SELECT _Id, _Nome FROM tb_usuario WHERE _Email = (?) AND _Senha = (?)";
            $stm = $this->con->prepare($cmd);
            $stm->bindValue(1, $u->getEmail());
            $stm->bindValue(2, $u->getSenha());
            try{
                $stm->execute();
                if($stm->rowCount() > 0){
                    $row = $stm->fetch(PDO::FETCH_ASSOC);
                    $usuario = new Usuario();
                    $usuario->setCodigo($row['_Id']);
                    $usuario->setNome($row['_Nome']);
                    return $usuario;
                }
                else{
                    return SEM_REGISTROS;
                }
            } catch (PDOException $e) {
                //echo "Erro -> ". $e;
                return ERRO_INSTRUCAO;
            }
        } 
        else {
            return ERRO_DB;
        }
    }

}
