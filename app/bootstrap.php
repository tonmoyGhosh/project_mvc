<?php 

require_once 'app/config/config.php';
require_once 'app/controller/Submission.php';

class Core {
    
    public function __construct()
    {       
        $url = $_SERVER['PHP_SELF']; 
        $filterParam = explode("/",$url);

        if(count($filterParam) > 3 && $filterParam[3] && $filterParam[4])
        {
            $controller = $filterParam[3];
            $method = $filterParam[4];
        }
        else
        {   
            $controller = 'Submission';
            $method = 'index';
        }

        $obj = new $controller;
        $exists = method_exists($obj, $method);
        ($exists == true) ? $obj->$method() : die('404 not found');
    }

}