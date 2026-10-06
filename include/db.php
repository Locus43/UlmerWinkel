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
            //@: the warning would show host and user name, the error is handled below
            @parent::__construct($this->host, $this->user, $this->passwd, $this->db);
            if(mysqli_connect_error()){
                //details only to the log, visitors must not see host or user name
                syslog(LOG_ERR, 'DB connection error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
                http_response_code(503);
                exit('Der Dienst ist vorübergehend nicht erreichbar. Bitte versuchen Sie es später erneut.');
            }
            parent::set_charset('utf8mb4');
        }
        //$params are bound to the ?-placeholders in $query (prepared statement)
        public function dbquery($query, $params = []){
            if($this->execute_query($query, $params ?: null)){
                return true;
            }else{
                return false;
            }
        }
        public function get_result($query, $params = []){
            $result = $this->execute_query($query, $params ?: null);
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_all();
                return $row;
            }else
                return [];
        }
    }