<?php
	$pdo = require '../connection.php';

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

	//addUser($pdo, 'naruto123', 'ruegie', 'ricohermoso', 'cutiepogi123');
 ?>