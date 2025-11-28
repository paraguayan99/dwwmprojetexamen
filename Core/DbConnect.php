<?php
namespace App\Core;

use PDO;
use Exception;

class DbConnect
{
    protected $connection;
    protected $request;

    // Permet aux autres classes (comme Models/User.php) de récupérer $connection sans violer l’encapsulation.
    public function getConnection()
    {
        return $this->connection;
    }

    // const SERVER = 'sqlprive-pc2372-001.eu.clouddb.ovh.net:35167';
    // const USER = 'cefiidev1493';
    // const PASSWORD = '2B3sB5Qgp';
    // const BASE = 'cefiidev1493';

    const SERVER = 'localhost';
    const USER = 'root';
    const PASSWORD = '';
    const BASE = 'championship';

    public function __construct()
    {
        try {
            $this->connection = new PDO('mysql:host=' . self::SERVER . ';dbname=' . self::BASE, self::USER, self::PASSWORD);

            // Activation des erreurs PDO
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Les retours de requête seront en Tableau objet par défaut
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

            // Encodage des caractères spéciaux en "utf8"
            $this->connection->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES utf8");
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}
?>