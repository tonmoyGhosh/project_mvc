<?php 

require_once 'app/config/config.php';
require_once 'app/controller/SubmissionController.php';

class Core {

    public function __construct()
    {   
        $controller =  new SubmissionController;
        $controller->index();
    }
}