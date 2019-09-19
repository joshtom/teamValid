<?php
    class User extends Validation{
        public $db;
        private $uid;
        public function __construct(){
            $dbi = new Connection();
            $this->db = $dbi->getDb();
            //$this->uid =  $_SESSION['user_id'];
        }
        public function passwordHash($username){
            $stmt = $this->db->prepare("select password from users where username = ?");
            $stmt->execute([$username]);
            $rc = $stmt->rowCount();
            if($rc == 1){
                $result = $stmt->fetch();
                return $result['password'];
            }
        }
        public function get_id($username){
            $query = $this->db->prepare("select id from users where username = ?");
            $query->execute([$username]);
            $record = $query->fetch();
            $id = $record['id'];
            return $id;
        }
        public function login($username, $password){
            $query = $this->db->prepare("select * from users where username = ? and password = ?"); 
            $query->execute([$username,$password]);
            return ($query->rowCount() == 1) ? $this->get_id($username) : false;
            //return $id;
        }
        public function create($data){
            
            $data[0]['password'] = password_hash($data[0]['password'], PASSWORD_DEFAULT);
            $array_keys = array_keys($data[0]);
            
            $co = count($data[0]);
            $plcd = '';
                for($i=0;$i<$co;$i++){
                    $plcd .= "?,";
                }
            $placeholder = substr($plcd,0,-1);
            $columns = implode(', ',$array_keys);   
            $values = implode(',',$data[0]);
            try{
                $stmt = $this->db->prepare("insert into users($columns)values($placeholder)");
                $array_data = explode(',',$values);
                $stmt->execute($array_data);
            }catch(PDOException $e){
                error_log($e->getMessage());
                exit($e);
            }
        }
        public function show($uid){
            $this->id = $uid;
            $func_num_args = func_num_args();
            if($func_num_args > 1){
                $func_get_args = func_get_args();
                unset($func_get_args[0]);
                $new_args = implode(',' ,$func_get_args);
                $query = $this->db->prepare("select $new_args from users where id = ?");
                $query->execute([$uid]);
                $record = $query->fetch();
                return $record;
            }
            
        }
        
    }
?>