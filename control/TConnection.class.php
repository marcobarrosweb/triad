<?php
/*
 * classe TConnection
 * gerencia conexões com bancos de dados através de arquivos de configuração.
 */

final class TConnection {
    /*
     * método __construct()
     * não existirão instâncias de TConnection, por isto estamos marcando-o como private
     */

    private function __construct() {
        
    }

    /*
     * método open()
     * recebe o nome do banco de dados e instancia o objeto PDO correspondente
     */

    public static function open() {
        $host = "127.0.0.1";
        $port = "3306";
        $user = "root";
        $pass = "root";
        $dbname = "mydb";
        $conn = new PDO("mysql:host={$host};dbname={$dbname}", $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

        // define para que o PDO lance exceções na ocorrência de erros
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // retorna o objeto instanciado.
        return $conn;
    }

}
?>
