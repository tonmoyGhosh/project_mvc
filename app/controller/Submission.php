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
                $inputParams = $_POST;  
                $rules = array(
                    'amount'        => 'required',
                    'buyer'         => 'required',
                    'buyer_email'   => 'required',
                    'city'          => 'required',
                    'items'         => 'required',
                    'note'          => 'required',
                    'phone'         => 'required',
                    'receipt_id'    => 'required',
                    'entry_by'      => 'required'
                );

                $validateResponse = $this->validate($inputParams, $rules);

                $phoneNoPrefix = substr($_POST['phone'],0, 3);

                // Input field validation check
                if($validateResponse['validateStatus'] == true)
                {
                    echo json_encode($validateResponse);
                    die();
                }
                if(strlen($_POST['buyer']) > 20)
                {   
                    $validateResponse = array(
                        'validateStatus' => true,
                        'buyer_msg'      => 'Buyer can not be more then 20 characters'
                    );

                    echo json_encode($validateResponse);
                    die();
                }
                if(!filter_var($_POST['buyer_email'], FILTER_VALIDATE_EMAIL)) 
                {
                    $validateResponse = array(
                        'validateStatus'    => true,
                        'buyer_email_msg'   => 'Buyer email is not valid'
                    );

                    echo json_encode($validateResponse);
                    die();
                }
                if(!ctype_alpha($_POST['receipt_id'])) 
                {
                    $validateResponse = array(
                        'validateStatus' => true,
                        'receipt_id_msg'      => 'Receipt id field allowed only text'
                    );

                    echo json_encode($validateResponse);
                    die();
                }
                if(is_numeric($_POST['amount']) == false)
                {   
                    $validateResponse = array(
                        'validateStatus' => true,
                        'amount_msg'     => 'Amount field allowed only number inputs'
                    );

                    echo json_encode($validateResponse);
                    die();
                }
                if(!ctype_alpha($_POST['city']))
                {   
                    $validateResponse = array(
                        'validateStatus' => true,
                        'city_msg'     => 'City field allowed only text'
                    );

                    echo json_encode($validateResponse);
                    die();
                }
                if(is_numeric($_POST['phone']) == false)
                {   
                    $validateResponse = array(
                        'validateStatus' => true,
                        'phone_msg'     => 'Phone no field allowed only number inputs'
                    );

                    echo json_encode($validateResponse);
                    die();
                }
                if(str_word_count($_POST['note']) > 30)
                {   
                    $validateResponse = array(
                        'validateStatus' => true,
                        'note_msg'      => 'Note can not be more then 30 words'
                    );

                    echo json_encode($validateResponse);
                    die();
                }
                if(is_numeric($_POST['entry_by']) == false)
                {   
                    $validateResponse = array(
                        'validateStatus' => true,
                        'entry_by_msg'     => 'Entry by field allowed only number inputs'
                    );

                    echo json_encode($validateResponse);
                    die();
                }
                if($phoneNoPrefix != '880')
                {   
                    $validateResponse = array(
                        'validateStatus' => true,
                        'phone_msg'     => 'Phone no is not valid'
                    );

                    echo json_encode($validateResponse);
                    die();
                }

                // Set cookie for 24 hours
                $cookie_name = 'User_check_for_form_submission';
                $cookie_expire =  time() + 86400;
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
                die();
            }
            else
            {
                $response = array(
                    'status' => false,
                    'msg'    => 'Submission not inserted successfully, please try again after 24 hours!'
                );
    
                echo json_encode($response);
                die();
            }
        }
        else
        {
            $response = array(
                'status' => false,
                'msg'    => 'Submission not inserted successfully, please try again!'
            );

            echo json_encode($response);
            die();
        }
    }

    private function validate($inputParams, $rules)
    {   
        $buyer_msg = $buyer_email_msg = $receipt_id_msg = $amount_msg = $city_msg = '';
        $phone_msg = $items_msg = $note_msg = $entry_by_msg = '';

        if(isset($rules['buyer']) && $inputParams['buyer'] == '') 
        {
            $buyer_msg = 'Buyer field is required';
        }
        if(isset($rules['buyer_email']) && $inputParams['buyer_email'] == '') 
        {
            $buyer_email_msg = 'Buyer email field is required';
        }
        if(isset($rules['receipt_id']) && $inputParams['receipt_id'] == '') 
        {
            $receipt_id_msg = 'Receipt id field is required';
        }
        if(isset($rules['amount']) && $inputParams['amount'] == '') 
        {
            $amount_msg = 'Amount field is required';
        }
        if(isset($rules['city']) && $inputParams['city'] == '') 
        {
            $city_msg = 'City field is required';
        }
        if(isset($rules['phone']) && $inputParams['phone'] == '') 
        {
            $phone_msg = 'Phone field is required';
        }
        if(isset($rules['items']) && $inputParams['items'] == '') 
        {
            $items_msg = 'Items field is required';
        }
        if(isset($rules['note']) && $inputParams['note'] == '') 
        {
            $note_msg = 'Note field is required';
        }
        if(isset($rules['entry_by']) && $inputParams['entry_by'] == '') 
        {
            $entry_by_msg = 'Entry by field is required';
        }

        (!$buyer_msg && !$buyer_email_msg && !$receipt_id_msg && !$amount_msg && !$city_msg && !$phone_msg && !$items_msg && !$note_msg && !$entry_by_msg) ? $validateStatus = false: $validateStatus = true;

        $responseMsg = array(
            'validateStatus'        => $validateStatus,
            'buyer_msg'             => $buyer_msg,
            'buyer_email_msg'       => $buyer_email_msg,
            'receipt_id_msg'        => $receipt_id_msg,
            'amount_msg'            => $amount_msg,
            'city_msg'              => $city_msg,
            'phone_msg'             => $phone_msg,
            'items_msg'             => $items_msg,
            'note_msg'              => $note_msg,
            'entry_by_msg'          => $entry_by_msg
        );

        return $responseMsg;
        
    }

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
        else
        {  
            $ip = $_SERVER['REMOTE_ADDR'];  
        }

        return $ip;  
    }  
    

}