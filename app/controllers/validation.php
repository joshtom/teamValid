<?php
    class Validation{
        public $errors;
        // public function __construct(){
        //     $dbi = new Connection();
        //     $this->db = $dbi->getDb();
        // }
        public function loggedIn(){
            return (isset($_SESSION['user_id'])) ? true : false;
        }
        public function errors($errors){
            $this->errors = $errors;
            foreach($this->errors as $error){
                return '<div class="alert alert-danger">'.$error.'</div>';
            }
        }
        public function log_errors($errors){
            $this->errors = $errors;
            foreach($this->errors as $error){
                return '<div class="alert alert-danger">'.$error.'</div>';
            }
        }
        public function email_exists($email){
            $query = $this->db->prepare("select email from users where email = ?");
            $query->execute([$email]);
            $record = $query->rowCount();
            return ($record == 1) ? true : false;
        }
        public function username_exists($username){
            $query = $this->db->prepare("select username from users where username = ?");
            $query->execute([$username]);
            $record = $query->rowCount();
            return ($record == 1) ? true : false;
        }
    }
?>
