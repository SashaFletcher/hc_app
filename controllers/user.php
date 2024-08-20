<?php

    /**
     * User namespace for:
     *  > Retrieve data on logged in user
     */

    namespace user {

        use \database\database;
        use \PDO;

        class user {

            function __construct() {
                $this->conn = new database;
            }

            /**
             * Public function -get
             * Retreives the logged in user details from DB
             */
            public function _get() {

                $dbc = $this->conn->connect();
                $session = $_COOKIE['__hcApp'];

                try {

                    $q = $dbc->prepare("SELECT hc_user.id, hc_user.firstname, hc_user.lastname FROM `hc_user` LEFT JOIN `hc_user` ON hc_user.session = :session WHERE hc_user.id = hc_user.userId");
                    $q->bindParam(':session', $session, PDO::PARAM_STR);
                    $q->execute();

                    $dbc = $this->conn->kill($dbc);

                    return $q->fetchObject();

                } catch(Exception $e) {
                    $this->conn->error($e);
                }

            }

        }

    }
?>