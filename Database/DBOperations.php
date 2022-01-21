<?php
    class DBOperations{
		public $con;
		
		function __construct(){
			require_once dirname(__FILE__).'/DBConnect.php';
			$db = new DBConnect();
			$this->con = $db->connect();
		}
		
		function Login($username){
			$stmt = $this->con->prepare("SELECT * FROM `Users` WHERE `Nev` = ?;");
			$stmt->bind_param("s", $username);
			$stmt->execute();
			$array = $stmt->get_result();
			$dbdata = array();
			while ( $row = $array->fetch_assoc())  {
				$dbdata[]=$row;
            }
		    return $dbdata;
		}
		
		function Reg($username, $password){
			$stmt = $this->con->prepare("INSERT INTO `Users`(`Nev`, `Password`) VALUES (?,?);");
			$stmt->bind_param("ss", $username, $password);
			$stmt->execute();
		    return;
		}
		
		function getThreads(){
			$stmt = $this->con->prepare("SELECT * FROM `Threads` WHERE 1");
			$stmt->execute();
			$array = $stmt->get_result();
			$dbdata = array();
			while ( $row = $array->fetch_assoc())  {
				$dbdata[]=$row;
            }
		    return $dbdata;
		}
		
		function getComments($For){
			$stmt = $this->con->prepare("SELECT *, Users.Nev AS 'CreatedByName' FROM `Komment` INNER JOIN `Users` ON `Users`.`Id` = `Komment`.`ByUser` WHERE `For` = ?;");
			$stmt->bind_param("i", $For);	
			$stmt->execute();
			$array = $stmt->get_result();
			$dbdata = array();
			while ( $row = $array->fetch_assoc())  {
				$dbdata[]=$row;
            }
		    return $dbdata;
		}
		
		function AddThread($Name, $By, $Date){
			$stmt = $this->con->prepare("INSERT INTO `Threads`( `Nev`, `CreatedBy`, `CreatedOn`) VALUES (?,?,?);");
			$stmt->bind_param("sis", $Name, $By, $Date);
			$stmt->execute();
		    return;
		}
		
		function AddComment($Text, $By, $Date, $For){
			$stmt = $this->con->prepare("INSERT INTO `Komment`(`ByUser`, `DateTime`,`For`,`Komment`) VALUES (?,?,?,?);");
			$stmt->bind_param("isis", $By, $Date,$For ,$Text);
			$stmt->execute();
		    return;
		}

	}
?>