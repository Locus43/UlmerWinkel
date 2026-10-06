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
            throw new Exception('Clone is not allowed.');
        }
        public function __unserialize(array $data)
        {
            throw new Exception('Deserializing is not allowed.');
        }
        public function __construct(){
            $config = parse_ini_file('config.ini.php');
            $this->host = $config['db_host'];
            $this->user = $config['db_user'];
            $this->passwd = $config['db_password'];
            $this->db = $config['db_name'];

            //PHP >= 8.1 throws exceptions by default, keep returning false on errors like before
            mysqli_report(MYSQLI_REPORT_OFF);
            parent::__construct($this->host, $this->user, $this->passwd, $this->db);
            if(mysqli_connect_error()){
                exit('Connection error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
            }
            parent::set_charset('utf8mb4');
        }
        public function dbquery($query){
            if($this->query($query)){
                return true;
            }else{
                return false;
            }
        }
        public function get_result($query){
            $result = $this->query($query);
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_all();
                return $row;
            }else
                return [];
        }
    }