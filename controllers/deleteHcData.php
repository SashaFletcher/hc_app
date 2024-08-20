<?php
   namespace deletedata {

        use \database\database;
        use \PDO;

        class deletedata {

            function __construct() {
                $this->conn = new database;
            }

            public function hc_delete($post) {

                $dbc = $this->conn->connect();
                $id = filter_var($_POST['delete_message'], FILTER_SANITIZE_NUMBER_INT);

                try {

                    $q = $dbc->prepare("DELETE FROM `hc_details` WHERE `id`=:id");
                    $q->bindParam(':id', $id, PDO::PARAM_INT);

                    $q->execute();
        
                    $dbc = $this->conn->kill($dbc);
                    header('location: /patient-information');
                    
                } catch(Exception $e) {
                    $this->conn->error($e);
                }

            }

        }

    }
?>