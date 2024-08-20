<?php
    namespace system {

        use \database\database;
        use \emails\emails;
        use \PDO;

        class system {

            function __construct() {
                $this->conn = new database;;
                $this->email = new emails;
            }

            /**
             * Public function _get
             * Retreives all users from the DB
             */
            public function _get() {

                $i = 1;
                $dbc = $this->conn->connect();
                try {

                    $q = $dbc->prepare("SELECT * FROM `hc_user` ORDER BY `firstname` ASC");
                    $q->execute();

                    $dbc = $this->conn->kill($dbc);
                    
                    while($r = $q->fetchObject() ){

                        echo '
                            <tr>
                                <th scope="row">' . $i . '</th>
                                <td>' . $r->firstname . ' ' . $r->lastname . '</td>
                                <td>' . $r->email . '</td>
                                <td></td>
                            </tr>
                        ';

                        $i++;

                    }

                } catch(Exception $e) {
                    $this->conn->error($e);
                }

            }


        }

    }
?>