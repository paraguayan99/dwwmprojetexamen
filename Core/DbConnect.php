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

    const SERVER = 'localhost';
    const USER = 'root';
    const PASSWORD = '';
    const BASE = 'championship';

    public function __construct()
    {
        try {
            // Durcir PDO / charset — Core/DbConnect.php
            // Dans le constructeur, améliore le DSN et quelques attributs PDO :
            // charset=utf8mb4 évite problèmes d'encodage (et failles potentielles).
            // ATTR_EMULATE_PREPARES = false améliore la sécurité des requêtes préparées.

            $dsn = 'mysql:host=' . self::SERVER . ';dbname=' . self::BASE . ';charset=utf8mb4';
                $this->connection = new PDO($dsn, self::USER, self::PASSWORD, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                    PDO::ATTR_EMULATE_PREPARES => false // forcer prepares natifs
                ]);


            // $this->connection = new PDO('mysql:host=' . self::SERVER . ';dbname=' . self::BASE, self::USER, self::PASSWORD);

            // // Activation des erreurs PDO
            // $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // // Les retours de requête seront en Tableau objet par défaut
            // $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

            // // Encodage des caractères spéciaux en "utf8"
            // $this->connection->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES utf8");
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}
?>