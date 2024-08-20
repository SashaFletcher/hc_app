<?php
    namespace login {

        use \database\database;
        use \PDO;

        class login {
            
            private $response = array();

            function __construct() {
                $this->conn = new database;
            }

            /**
             * Private function _username
             * Checks the username submitted in the form esists
             */
            private function _username($str) {

                $email = filter_var($str, FILTER_SANITIZE_EMAIL);

                if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $response['error'] = 'Email Address failed validation';
                } else {
                    $response['str'] = $email;
                }

                return json_encode($response);

            }

            /**
             * Public function _run
             * Logs in the user using submitted details
             */
            public function _run($data) {

                $email = $data['email'];
                $pass = $data['pass'];

                $email = json_decode($this->_username($email));

                if(!empty($email->error)) {
                    return $email->error;                    
                } elseif($email->str) {

                    $dbc = $this->conn->connect();
                    try {

                        $q = $dbc->prepare("SELECT `id`, `password` FROM `hc_user` WHERE `email` = :email");
                        $q->bindParam(':email', $email->str, PDO::PARAM_STR);
                        $q->execute();

                        if($q->rowCount() == 0) {
                            return 'Email Address not found.';
                            die();
                        } else {

                            $r = $q->fetchObject();

                            if(!password_verify($pass, $r->password)) {
                                return 'Incorrect password.';
                                die();
                            } else {

                                $userId = $r->id;
                                $session = bin2hex(random_bytes(32));
                                $timeout = date('Y-m-d H:i:s', strtotime('today 23:59'));

                                $q = $dbc->prepare("UPDATE `hc_user` SET `session` = :session, `timeout` = :timeout WHERE `userId` = :userId");
                                $q->bindParam(':userId', $userId, PDO::PARAM_INT);
                                $q->bindParam(':session', $session, PDO::PARAM_STR);
                                $q->bindParam(':timeout', $timeout, PDO::PARAM_STR);
                                $q->execute();

                                setcookie(
                                    '__hcApp',
                                    $session,
                                    strtotime('today 23:59'),
                                    '/home/',
                                    $_SERVER['HTTP_HOST'],
                                    true,
                                    true
                                );
                                
                                $dbc = $this->conn->kill($dbc);

                                header('location: /home');
                                die();

                            }

                        }

                    } catch(Exception $e) {
                        $this->conn->error($e);
                    }

                }

            }

        }

    }
?>