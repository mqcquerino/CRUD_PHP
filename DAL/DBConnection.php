<?php

/**
 * @author Marcelo
 */
//A Classe não permite herança
final class DBConnection {

    private static $pdo = null;

    //Construtor privado (A classe não permite que seja instanciada)
    private function __construct() {
        
    }

    /*  Método retorna uma instancia pdo já existente ou cria uma nova e a retorna
     * @return false ou objeto pdo
     */  
    public function getInstance() {
        if (self::$pdo == null) {
            try {
                DBConnection::$pdo = new PDO("mysql:host=" . HOST . "; dbname=" . DBNAME . ";", USER, PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                DBConnection::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return DBConnection::$pdo;
            } catch (PDOException $e) {
                echo "Erro ao realizar a conexão com a base de dados! Verifique o usuario e senha do servidor mysql em /DAL/Config.php \nDescrição: " . $e;
                return false;
            }
        } else {
            return self::pdo;
        }
    }

}
