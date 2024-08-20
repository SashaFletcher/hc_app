<?php

    /**
     * Database namespace for:
     *  > Connection
     *  > Error handling
     *  > Killing connection
     */

    namespace cookies {

        use \PDO;
        use database\database;

        class cookies {
            
            function __construct() {
                $this->conn = new database;
            }

            /**
             * Public function _check
             * Will check the logged in user is valid using the __sp cookie
             */
            public function _check($page) {

                if(!isset($_COOKIE['_hcApp'])) {

                    if($page != 'signin') {
                        header('location: /');
                        die();
                    }

                } else {

                    if($page == 'signin') {
                        header('location: /');
                        die();
                    } else {

                        $dbc = $this->conn->connect();
                        try {

                            $q = $dbc->prepare("SELECT `timeout` FROM `pc_sessions` WHERE `session` = :session");
                            $q->bindParam(':session', $_COOKIE['__hcApp'], PDO::PARAM_STR);
                            $q->execute();
                            $r = $q->fetchObject();

                            if($r->timeout == NULL) {
                                header('location: /');
                                die();
                            } elseif(time() > strtotime($r->timeout)) {
                                header('location: /');
                                die();
                            }

                            $dbc = $this->conn->kill($dbc);

                            return true;

                        } catch(Exception $e) {
                            $this->conn->error($e);
                        }
                    
                    }

                }

            }

            /**
             * Public function _kill
             * Kills the cookie so the user is logged out
             */
            public function _kill() {

                if(empty($_COOKIE['__hcApp'])) {

                    header('location: /');
                    die();

                } else {

                    $session = $_COOKIE['__hcApp'];
                    $dbc = $this->conn->connect();
                    try {

                        $q = $dbc->prepare("UPDATE `pc_sessions` SET `timeout` = NULL WHERE `session` = :session");
                        $q->bindParam(':session', $session, PDO::PARAM_STR);
                        $q->execute();

                        $dbc = $this->conn->kill($dbc);

                        setcookie(
                            '__hcApp',
                            NULL,
                            time() - 1000,
                            '/home/',
                            $_SERVER['HTTP_HOST'],
                            true,
                            true
                        );

                        header('location: /');
                        die();

                    } catch(Exception $e) {
                        $this->conn->error($e);
                    }

                }

            }

        }

    }
?>