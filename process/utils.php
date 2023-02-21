<?php
	$pdo = require '../connection.php';

	if (isset($_POST['addUserBtn'])) {
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$username = $_POST['username'];
		$upass = password_hash($_POST['upass'], PASSWORD_DEFAULT);

		if (checkUsername($pdo, $username) == True) {
			echo '<script>alert("Username Already Exist!!")</script>';
		} else {
			addUser($pdo, $username, $firstname, $lastname, $upass);
			echo '<script>alert("Added Succesfully")</script>';
		};
		unset($_POST['addUserBtn']);
	};

	if (isset($_POST['addBookBtn'])) {
		$title = $_POST['title'];
		$author = $_POST['author'];
		$description = $_POST['description'];
		$categoryID = $_POST['options'];

		if ($_FILES['Image']['error'] === 4) {
			echo "<script> alert('Error code 4: No file uploaded');</script>";
		}else{
			$filename = $_FILES['Image']['name'];
			$filesize = $_FILES['Image']['size'];
			$tmpname = $_FILES['Image']['tmp_name'];

			$validImageExtension = ['jpg', 'jpeg', 'png'];
			$imageExtension = explode('.', $filename);
			$imageExtension = strtolower(end($imageExtension));
			if (!in_array($imageExtension, $validImageExtension)) {
				echo "<script> alert('Image Does Not Exist');</script>";
			}else if($filesize > 1000000){
				echo "<script> alert('Image Size is too large');</script>";
			}else{
				$newImageName = uniqid();
				$newImageName .= '.' .$imageExtension;
				move_uploaded_file($tmpname, 'media/'.$newImageName);
				addBook($pdo, $title, $author, $description, $newImageName, $categoryID);
				echo '<script> alert("Book Added Succesfully")</script>';
				header('Location: index.php');
			}
		};
		unset($_POST['addBookBtn']);
	};

	if (isset($_POST['loginBtn'])) {
		$username = $_POST['username'];
		$upass = $_POST['upass'];

		checkUser($pdo, $username, $upass);

	};



	function checkUser($pdo, $username, $upass) {
		try {
			$sql = 'SELECT * FROM User_List WHERE username=?';
			$statement = $pdo->prepare($sql);
			$statement->execute([$username]);
			$user = $statement->fetch();

			if ($user && password_verify($upass, $user['upass'])) {
				session_start();
				$_SESSION['logged_in'] = true;
				$_SESSION['username'] = $username;
				header('Location: index.php');
			}else {
				echo '<script> alert("Invalid username or password") </script>';
			}
		} catch (Exception $e) {
			echo 'Message: '.$e->getMessage();
		}
	}

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