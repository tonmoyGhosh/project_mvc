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
            $data = [
                'amount' => $_POST['amount']
               
            ];

            $this->submissionModel->addSubmission($data);
            $this->index();
        }
        else $this->view('submission/create');
         
    }

}