<?php

include_once('TConnection.class.php');
/*
 * classe TTransaction
 * esta classe prov� os m�todos necess�rios manipular transa��es
 */

final class TTransaction {

    private static $conn;   // conex�o ativa
    private static $logger; // objeto de LOG

    /*
     * m�todo __construct()
     * Est� declarado como private para impedir que se crie inst�ncias de TTransaction
     */

    private function __construct() {
        
    }

    /*
     * m�todo open()
     * Abre uma transa��o e uma conex�o ao BD
     * @param $database = nome do banco de dados
     */

    public static function open() {
        // abre uma conex�o e armazena na propriedade est�tica $conn
        if (empty(self::$conn)) {
            self::$conn = TConnection::open();
            // inicia a transa��o
            self::$conn->beginTransaction();
            // desliga o log de SQL
            self::$logger = NULL;
        }
    }

    /*
     * m�todo get()
     * retorna a conex�o ativa da transa��o
     */

    public static function get() {
        // retorna a conex�o ativa
        return self::$conn;
    }

    /*
     * m�todo rollback()
     * desfaz todas opera��es realizadas na transa��o
     */

    public static function rollback() {
        if (self::$conn) {
            // desfaz as opera��es realizadas durante a transa��o
            self::$conn->rollback();
            self::$conn = NULL;
        }
    }

    /*
     * m�todo close()
     * Aplica todas opera��es realizadas e fecha a transa��o
     */

    public static function close() {
        if (self::$conn) {
            // aplica as opera��es realizadas
            // durante a transa��o
            self::$conn->commit();
            self::$conn = NULL;
        }
    }

    /*
     * m�todo setLogger()
     * define qual estrat�gia (algoritmo de LOG ser� usado)
     */

    public static function setLogger(TLogger $logger) {
        self::$logger = $logger;
    }

    /*
     * m�todo log()
     * armazena uma mensagem no arquivo de LOG
     * baseada na estrat�gia ($logger) atual
     */

    public static function log($message) {
        // verifica existe um logger
        if (self::$logger) {
            self::$logger->write($message);
        }
    }

}

?>