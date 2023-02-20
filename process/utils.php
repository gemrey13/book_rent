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
	} elseif (isset($_POST['addBookBtn'])) {
		$title = $_POST['title'];
		$author = $_POST['author'];
		$description = $_POST['description'];
		$categoryID = $_POST['options'];

		if (JVB) {
			// code...
		}
		// $target_dir = '../media/';
		// $target_file = $target_dir.basename($_FILES['image']['name']);
		
		// $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		// $check = getimagesize($_FILES["image"]["tmp_name"]);

		// if($check !== false) {
		//     addBook($pdo, $title, $author, $description, $target_file, $categoryID);
 		// 	move_uploaded_file($_FILES['image']['tmp_name'],$target_file);
 		// 	if (move_uploaded_file($_FILES['image']['tmp_name'],$target_file)) {
 		// 		echo '<script>alert("Upload success")</script>';
 		// 	}
		// 	echo '<script>alert("Book Publish Successfully")</script>';
		//   } else {
		//     echo '<script>alert("Error Publishing Book!!")</script>';
		//   };
		
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

   


    function addBook($pdo, $title, $author, $description, $image, $categoryID) {
    	try {
    		$sql = 'INSERT INTO Book_List (title, author, description, image, categoryID) VALUES (:title, :author, :description, :image, :categoryID)';
    		$statement = $pdo->prepare($sql);
    		$statement->bindValue(':title', $title);
    		$statement->bindValue(':author', $author);
    		$statement->bindValue(':description', $description);
    		$statement->bindValue(':image', $image);
    		$statement->bindValue(':categoryID', $categoryID);
    		$statement->execute();
    	}catch(Exception $e) {
    		echo 'Message: '.$e->getMessage();
    	};
    	$pdo = null;
    	$sql = null;
    };






    function showCategories($pdo) {
    	$sql = 'SELECT * from Categories';
    	$statement = $pdo->query($sql);
    	$row = $statement->fetchAll(PDO::FETCH_ASSOC);

    	echo '<select name="options">';
    	foreach ($row as $r) {
    		echo '<option value="'.$r['categoryID'].'">'
    		.$r['name'] .'
    		</option>';
    	}
    	echo '</select>';

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