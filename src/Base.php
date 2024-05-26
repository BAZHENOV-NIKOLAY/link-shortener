<?php
    require_once 'src/Config.php';
    //require_once 'src/Auth.php';
    

    $db = Database::getDBO();
    //$request = new Request();
    
	
	
	
    function to404() {
        header('Location: 404.php');
        exit;
    }
    
    function to403() {
        header('Location: 403.php');
        exit;
    }	
	
	
	
?>