<?php

require_once 'app/libraries/Controller.php';

class Submission extends Controller {

    public function __construct()
    {
        $this->submissionModel = $this->model('SubmissionModel');
    }

    public function index()
    {
        $submissionsList = $this->submissionModel->getSubmissions();

        $data = [
            'submissionsList' => $submissionsList
        ];
        
        $this->view('submission/index', $data);
    }

    public function create()
    {   
        $this->view('submission/create');
    }

    public function store()
    {       
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {     
            if(!isset($_COOKIE['User_check_for_form_submission']))
            {   
                
                // $inputParams = $_POST;  
                // $rules = array(
                //     'amount'        => 'required',
                //     'buyer'         => 'required',
                //     'buyer_email'   => 'required',
                //     'city'          => 'required',
                //     'items'         => 'required',
                //     'note'          => 'required',
                //     'phone'         => 'required',
                //     'receipt_id'    => 'required',

                // );

                // $validateResponse = $this->validate($inputParams, $rules);

                // echo json_encode($validateResponse);
                // die();

                // Set cookie for 24 hours
                $cookie_name = 'User_check_for_form_submission';
                $cookie_expire = time() + 60;
                setcookie($cookie_name, $cookie_expire);

                // Get IP address
                $ipAddress = $this->getIPAddress();  

                // Generate proper ‘salt’ using sha-512 for hash key
                $salt_prefix = uniqid(mt_rand());
                $salt_postfix = uniqid(mt_rand());
                $combine = $salt_prefix.''.$_POST['receipt_id'].''.$salt_postfix;
                $hash_key = hash("sha512", $combine);

                $data = [
                    'buyer'         => $_POST['buyer'],
                    'buyer_email'   => $_POST['buyer_email'],
                    'receipt_id'    => $_POST['receipt_id'],
                    'city'          => $_POST['city'],
                    'items'         => $_POST['items'],
                    'note'          => $_POST['note'],
                    'phone'         => $_POST['phone'],
                    'amount'        => $_POST['amount'],
                    'buyer_ip'      => $ipAddress,
                    'entry_at'      => date('Y-m-d'),
                    'entry_by'      => $_POST['entry_by'],
                    'hash_key'      => $hash_key,
                ];

                $this->submissionModel->addSubmission($data);

                $response = array(
                    'status' => true,
                    'msg'    => 'Submission inserted successfully!'
                );

                echo json_encode($response);

                
            }
            else
            {
                $response = array(
                    'status' => false,
                    'msg'    => 'Submission not inserted successfully, please try again after 1 mintue!'
                );
    
                echo json_encode($response);
            }
        }
        else
        {
            $response = array(
                'status' => false,
                'msg'    => 'Submission not inserted successfully, please try again!'
            );

            echo json_encode($response);
        }
    }

    // private function validate($inputParams, $rules)
    // {
    //     if(isset($rules['amount'])) 
    //     {

    //     }
        
    // }

    private function getIPAddress() 
    {  
        //whether ip is from the share internet  
        if(!empty($_SERVER['HTTP_CLIENT_IP'])) 
        {  
                $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }  
        //whether ip is from the proxy  
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) 
        {  
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
        }  
        //whether ip is from the remote address  
        else{  
                 $ip = $_SERVER['REMOTE_ADDR'];  
         }  
         return $ip;  
    }  
    

}