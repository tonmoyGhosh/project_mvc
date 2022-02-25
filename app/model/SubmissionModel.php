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
        $result = $this->db->query("INSERT INTO submissions (
                                                amount, 
                                                buyer,
                                                receipt_id,
                                                items,
                                                buyer_email,
                                                buyer_ip,
                                                note,
                                                city,
                                                phone,
                                                hash_key,
                                                entry_at,
                                                entry_by
                                            ) 
                                            VALUES (
                                                '".$data['amount']."', 
                                                '".$data['buyer']."',
                                                '".$data['receipt_id']."',
                                                '".$data['items']."',
                                                '".$data['buyer_email']."',
                                                '".$data['buyer_ip']."',
                                                '".$data['note']."',
                                                '".$data['city']."',
                                                '".$data['phone']."',
                                                '".$data['hash_key']."',
                                                '".$data['entry_at']."',
                                                '".$data['entry_by']."'
                                            )
                                    ");
        return $result;
    }
    
}