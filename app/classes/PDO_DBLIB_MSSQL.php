<?php
class PDO_DBLIB_MSSQL{

    private $db;
    private $cTransID;
    private $childTrans = array();

    public function __construct($hostname, $port, $dbname, $username, $pwd){

        $this->hostname = $hostname;
        $this->port = $port;
        $this->dbname = $dbname;
        $this->username = $username;
        $this->pwd = $pwd;

        $this->connect();
        
    }

    public function beginTransaction(){

        $cAlphanum = "AaBbCc0Dd1EeF2fG3gH4hI5iJ6jK7kLlM8mN9nOoPpQqRrSsTtUuVvWwXxYyZz";
        $this->cTransID = "T".substr(str_shuffle($cAlphanum), 0, 7);

        array_unshift($this->childTrans, $this->cTransID);

        $stmt = $this->db->prepare("BEGIN TRAN [$this->cTransID];");
        return $stmt->execute();

    }

    public function rollBack(){
        
        while(count($this->childTrans) > 0){
            $cTmp = array_shift($this->childTrans);
            $stmt = $this->db->prepare("ROLLBACK TRAN [$cTmp];");
            $stmt->execute();
        }

        return $stmt;
    }

    public function commit(){

        while(count($this->childTrans) > 0){
            $cTmp = array_shift($this->childTrans);
            $stmt = $this->db->prepare("COMMIT TRAN [$cTmp];");
            $stmt->execute();
        }

        return  $stmt;
    }

    public function select($q, $fetchMode=PDO::FETCH_COLUMN){
        return $this->db->query($q, $fetchMode);
    }

    public function close(){
        $this->db = null;
    }

    public function connect(){

        try {
            $this->db = new PDO ("dblib:host=$this->hostname:$this->port;dbname=$this->dbname", "$this->username", "$this->pwd");
            //$this->db = new PDO("sqlsrv:server = tcp:barnes-crm-data-server.database.windows.net,1433; Database = barnes_data", "barnes_admin", "(38EPRa?ZJ");
            //$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //$this->db->setAttribute(PDO::SQLSRV_ATTR_ENCODING, PDO::SQLSRV_ENCODING_UTF8);
        } catch (PDOException $e) {
            echo "Failed to get DB handle: " . $e->getMessage() . "\n";
        }

    }

}