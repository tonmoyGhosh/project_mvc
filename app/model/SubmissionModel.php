<?php

require_once 'app/libraries/database.php';

class SubmissionModel {
    
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getSubmissions()
    {
        $result = $this->db->query('SELECT * FROM submissions ORDER BY submissions.entry_at DESC');
        return $result;
    }

    public function addSubmission($data)
    {
        $result = $this->db->query("INSERT INTO submissions (amount) VALUES ('".$data['amount']."')");
        return $result;
    }
    
}