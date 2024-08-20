<?php
    namespace hcdata {

        use \database\database;
        //use ..\..\controllers\commessagebanner\commessage;
        use \PDO;

       // $bannerMessage = new commmessage;
        class hcdata {

            function __construct() {
                $this->conn = new database;
            }

            //save banner message
            public function save($post) {

                $dbc = $this->conn->connect();
                try {
                        
                    $id = filter_var($post['id'], FILTER_SANITIZE_NUMBER_INT);
                    $first_name = filter_var($post['firstname'], FILTER_SANITIZE_STRING);
                    $last_name = $post['lastname'];
                    $email = $post['email'];
                    $phone_number = $post['phonenumber'];
                    $nhs_no = $post['nhsno'];
                    $address = $post['address'];
                    $dob = $post['dob'];
                    $gender = $post['gender'];

                    if($id) {
        
                        $q = $dbc->prepare("UPDATE `hc_details` SET `first_name` = :firstname, `last_name` = :last_name, `email` = :email, `phone_number` = :phone_number, `nhs_no` = :nhs_no, `dob` = :dob, `gender` = :gender, WHERE `id` = :id");
                        $q->bindParam(':id', $id, PDO::PARAM_INT);

                    } else {
                        
                    }

                    $q->bindParam(':first_name', $first_name, PDO::PARAM_STR);
                    $q->bindParam(':last_name', $last_name, PDO::PARAM_INT);
                    $q->bindParam(':email', $email, PDO::PARAM_INT);
                    $q->bindParam(':phone_number', $phone_number, PDO::PARAM_INT);
                    $q->bindParam(':nhs_no', $nhs_no, PDO::PARAM_INT);
                    $q->bindParam(':address', $address, PDO::PARAM_INT);
                    $q->bindParam(':dob', $dob, PDO::PARAM_INT);
                    $q->bindParam(':gender', $gender, PDO::PARAM_INT);
                    $q->execute();
        
                    $dbc = $this->conn->kill($dbc);

                    header('location: patient-info');
                    die();
        
                } catch(Exception $e) {
                    $this->conn->error($e);
                }

            }

            //List all messages on the messages.php portal page
            public function list() {

                $array = array();

                $dbc = $this->conn->connect();
                try {

                    $q = $dbc->prepare("SELECT id, first_name, last_name, email, phone_number, nhs_no, address, dob, gender  FROM `hc_details` ORDER BY `id` ASC");


                    $q->execute();

                    $dbc = $this->conn->kill($dbc);

                    while($r = $q->fetchObject()) {

                        $array[] = $r;
                    }

                    return $array;

                } catch(Exception $e) {
                    $this->conn->error($e);
                }

            }

            // Edit banner messages
            public function get($id) {

                $dbc = $this->conn->connect();
                try {
        
                    $q = $dbc->prepare("SELECT * FROM `hc_details` WHERE `id` = :id");
                    $q->bindParam(':id', $id, PDO::PARAM_INT);
                    $q->execute();

                    $dbc = $this->conn->kill($dbc);

                    return $q->fetchObject();
        
                } catch(Exception $e) {
                    $this->conn->error($e);
                }

            }

            //Get banner messages 
            public function _getBanMess($category, $query = "") {

                if($category) {
                    $query = "AND `category` = :category";
                }
                
                $dbc = $this->conn->connect();
                try {

                    $q = $dbc->prepare("SELECT content, category, id FROM admin_messages am1 WHERE id = ( SELECT MAX( am2.id ) FROM admin_messages am2 WHERE am1.category = am2.category )" . $query . " ORDER BY category;");
                    

                    if($category) {
                        $q->bindparam(":category", $category, PDO::PARAM_INT);
                    }
                    $q->execute();
                    
                    while($r = $q->fetchObject()) {
                        
                        echo $r->content;
                    }
                    
                } catch(Exception $e) {
                    $this->conn->error($e);
                }

            }

        }

    }
?>