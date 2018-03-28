<?php
/**
 * Created by PhpStorm.
 * User: skyro
 * Date: 27/03/2018
 * Time: 10:55
 */

namespace db;

use PDO;

include __DIR__.'/config/configDB.php';

class Database extends PDO {

    // Properties
    private $db, $host, $port, $dbName, $user, $pass;

    public function __construct()
    {
        global $GLOBALS;
        $this->host     = $GLOBALS['host'];
        $this->port     = $GLOBALS['port'];
        $this->dbName   = $GLOBALS['dbName'];
        $this->user     = $GLOBALS['user'];
        $this->pass     = $GLOBALS['pass'];

        $options = [
            PDO::ATTR_EMULATE_PREPARES   => false, // turn off emulation mode for "real" prepared statements
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //make the default fetch be an associative array
        ];

        try {
            $this->db = new PDO('mysql:host='.$this->host.';port='.$this->port.';dbname='.$this->dbName,
                                $this->user,
                                $this->pass,
                                $options);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function getDB() {
        return $this->db;
    }
}