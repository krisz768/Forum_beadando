<?php

    ini_set('display_errors', 0);

	$response = array();


    if (isset($_POST['type'])) {
        //sleep(5);
        switch ($_POST['type']) {
            case 0: Login(); break;
            case 1: Reg(); break;
			case 2: LogOut(); break;
            case 3: GetThreads(); break;
            case 4: AddThread(); break;
            case 5: GetComments(); break;
			case 6: AddComment(); break;

            default: $response['error'] = true; $response['data'] = "Invalid Request."; break;
        }
    } else {
        $response['error'] = true; $response['data'] = "Invalid Request.";
    }

    //echo var_dump($response);
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
	
	function Login () {
		global $response;
		$db = new DBOperations();
		$userdata = $db->Login($_POST['Username']);
		
		if (empty($userdata) or md5($_POST['Password'] . "pass") != $userdata[0]['Password']) {
			$response['error'] = true;
			$response['data'] = "Invalid username or password.";
		} else {
			$_SESSION["LoggedIn"] = true;
			$_SESSION["Id"] = $userdata[0]['Id'];
			$_SESSION["Name"] = $userdata[0]['Nev'];
			
			$response['error'] = false;
			$response['data'] = "Login successful!";
		}
	}
	
	function LogOut() {
		global $response;
		
		$_SESSION["LoggedIn"] = false;
		$_SESSION["Id"] = null;
		$_SESSION["Name"] = null;
		
		$response['error'] = false;
		$response['data'] = "Logout successful!";
	}
	
	function Reg () {
		global $response;
		$db = new DBOperations();
		$userdata = $db->Reg($_POST['Username'], md5($_POST['Password'] . "pass"));
		
		$response['error'] = false;
		$response['data'] = "Reg successful!";
	}
	
	function GetThreads () {
		global $response;
		$db = new DBOperations();
		$userdata = $db->getThreads();
		
		$response['error'] = false;
		$response['data'] = $userdata;
	}
	
	function GetComments () {
		global $response;
		$db = new DBOperations();
		$userdata = $db->GetComments();
		
		$response['error'] = false;
		$response['data'] = $userdata;
	}
	
	function AddThread () {
		global $response;
		$db = new DBOperations();
		$userdata = $db->AddThread($_POST['Name'], $_SESSION["Id"], date('c'));
		
		$response['error'] = false;
		$response['data'] = "successful!";
	}
	
	function AddComment () {
		global $response;
		$db = new DBOperations();
		$userdata = $db->AddComment($_POST['Text'], $_SESSION["Id"], date('c'),$_POST['For']);
		
		$response['error'] = false;
		$response['data'] = "successful!";
	}