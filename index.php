<?php
	session_start();
	mb_internal_encoding("UTF-8");
	require_once './Database/DBOperations.php';

	if ($_SERVER['REQUEST_METHOD']=='POST') {
        require_once './Req.php';
    } else {
        if (isset($_SESSION["LoggedIn"]) and $_SESSION["LoggedIn"]) {
            $Login = true;
        } else {
            $Login = false;
        }
		require_once './Page.php';
    }
	
	
?>