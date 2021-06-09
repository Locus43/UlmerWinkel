<?php

    class db extends mysqli{
        private static $instance = null;
        private $user;
        private $passwd;
        private $db;
        private $host;

        public static function getInstance(){
            if(!self::$instance instanceof self){
                self::$instance = new self;
            }
            return self::$instance;
        }

        public function __clone(){
            trigger_error('Clone is not allowed.', E_USER_ERROR);
        }
        public function __wakeup()
        {
            trigger_error('Deserializing is not allowed.', E_USER_ERROR);
        }
        public function __construct(){
            $config = parse_ini_file('config.ini.php');
            $this->host = $config['db_host'];
            $this->user = $config['db_user'];
            $this->passwd = $config['db_password'];
            $this->db = $config['db_name'];

            parent::__construct($this->host, $this->user, $this->passwd, $this->db);
            if(mysqli_connect_error()){
                exit('Connection error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
            }
            parent::set_charset('utf-8');
        }
        public function dbquery($query){
            if($this->query($query)){
                return true;
            }else{
                return false;
            }
        }
        public function get_result($query)
        {
            $result = $this->query($query);
            if ($result->num_rows > 0) {
                $row = $result->fetch_all();
                return $row;
            }else
                return null;
        }
    }