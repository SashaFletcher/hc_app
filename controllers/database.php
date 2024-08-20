<?php
namespace database {
    /**
        * Database namespace for:
        *  > Connection
        *  > Error handling
        *  > Killing connection
        */

    /**
        * Loads the PDO namespace, otherwise will throw a fatal error.
        * Loads the global namespace for glabel variables.
        */
    use \globals\globals;
    use \PDO;

    require_once $_SERVER["DOCUMENT_ROOT"] . "/controllers/globals.php";

    class database {

        /**
            * Database credentials & SSL certificate locations
            */
        private static function db($credential) {

            $array = array();

            $array["host"] = "localhost";
            $array["pass"] = "x5fvF63SNaBfvKsu";
            $array["user"] = "hc_app";
            $array["database"] = "hc_app_db";
            $array["charset"] = "utf8";

            return $array[$credential];

        }

        function __construct() {
            $this->host = SELF::db("host");
            $this->user = SELF::db("user");
            $this->pass = SELF::db("pass");
            $this->database = SELF::db("database");
            $this->charset = SELF::db("charset");
        }

        /**
            * public function connect()
            * Creates a PDO instance representing a connection to a database
            */
        public function connect() {

            try {

                $options = [
                    PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_EMULATE_PREPARES => false,
                    PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
                ];

                $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->database . ";charset=" . $this->charset;

                $conn = new PDO($dsn, $this->user, $this->pass, $options);

                return $conn;
            
            } catch(PDOException $e) {
                $this->error($e);
            }

        }

        /**
            * public function kill()
            * Kills the connection to the database to help with max number of connections
            */
        public function kill($connection) {

            $connection = null;
            return $connection;

        }

    }
    
}
?>