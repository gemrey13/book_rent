<?php
	$pdo = require '../connection.php';

	if (isset($_POST['addUserBtn'])) {
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$username = $_POST['username'];
		$upass = $_POST['upass'];

		if (checkUsername($pdo, $username) == True) {
			echo '<script>alert("Username Already Exist!!")</script>';
		} else {
			addUser($pdo, $username, $firstname, $lastname, $upass);
			echo '<script>alert("Added Succesfully")</script>';
		};
		unset($_POST['addUserBtn']);
	};




	function addUser($pdo, $username, $firstname, $lastname, $upass) {
		try {
			$sql = 'INSERT INTO User_List (username, firstname, lastname, upass) VALUES (:username, :firstname, :lastname, :upass)';
			$statement = $pdo->prepare($sql);
			$statement->bindValue(':username', $username);
			$statement->bindValue(':firstname', $firstname);
			$statement->bindValue(':lastname', $lastname);
			$statement->bindValue(':upass', $upass);
			$statement->execute();
		}catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        };
        $pdo = null;
        $sql = null;
    };


    function checkUsername($pdo, $username) {
    	try {
    		$sql = 'SELECT count(username) as rowCount FROM User_List where username=:username';
    		$statement = $pdo->prepare($sql);
    		$statement->bindValue(':username', $username);
    		$statement->execute();
    		$row = $statement->fetch(PDO::FETCH_ASSOC);
    		if ($row['rowCount'] > 0) {
    			return True;
    		} else {
    			return False;
    		}
    	} catch (Exception $e) {
    		echo 'Caught Exception: ', $e->getMessage(), '\n';
    	}
    };
	
 ?>