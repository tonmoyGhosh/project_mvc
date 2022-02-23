<?php
  /*
   * Connect to database
   * Create Query statements
   * Return results
   */

class Database {

    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;
    private $conn = '';

    public function __construct()
    {   
        // Create connection
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->dbname);

        // Check connection
        if ($this->conn->connect_error) 
        {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // Prepare statement with query
    public function query($sql)
    {
        $result = $this->conn->query($sql);
        return $result;
    }

}