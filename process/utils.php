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
		} else {
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
				$imageName = $_FILES['Image'];
				move_uploaded_file($tmpname, 'media/'.$newImageName);
				echo 'Image: ' .$newImageName;
				echo '<script> alert("Image Move Succesfully")</script>';
				addBook($pdo, $title, $author, $description, $newImageName, $categoryID);
				echo '<script> alert("Book Added Succesfully")</script>';
				header('Location: blog.php');
			}
		};
		unset($_POST['addBookBtn']);
	};



	if (isset($_POST['loginBtn'])) {
		$username = $_POST['username'];
		$upass = $_POST['upass'];

		checkUser($pdo, $username, $upass);
	};





	function randomImage() {
		$dir = 'media/';
		$ext = array('jpg', 'jpeg', 'png');
		$files = glob('media/*.{'.implode(',',$ext). '}', GLOB_BRACE);
		$randomFile = $files[array_rand($files)];
		echo $randomFile;
	}





	function searchQuery($pdo, $searchTitle){
		$pattern = '%'.$searchTitle.'%';
		$sql = 'SELECT * FROM Book_List WHERE title LIKE :pattern OR author LIKE :pattern ORDER BY Book_List.bookID DESC';
		$statement = $pdo->prepare($sql);
		$statement->bindValue(':pattern', $pattern);
		$statement->execute();
		$rows = $statement->fetchAll(PDO::FETCH_ASSOC);

		if (count($rows) <= 0) {
			echo '<h1 class="noResult">No Result</h1>';
			echo '<a href="addBook.php" class="blog-post_cta" id="addPost1">Add Post</a>';
		}else{
			echo '<a href="addBook.php" class="blog-post_cta" id="addPost">Add Post</a>';
			foreach ($rows as $row) {
				echo '
						<div class="container">
							<div class="blog-post">
								<div class="blog-post_img">
									<img src="media/'.$row['image'].'" alt="">
								</div>

								<div class="blog-post_info">
									<div class="blog-post_date">
										<span>'.$row['author'].'</span>
										<span>'.$row['date_posted'].'</span>
									</div>
									<h1 class="blog-post_title">'.$row['title'].'</h1>
									<p class="blog-post_text">'.$row['description'].'
									</p>
									<a href="#" class="blog-post_cta">Read More</a>
								</div>
							</div>
						</div>

						';
			}
		}
        $pdo = null;
        $sql = null;
            
	}






	function blog($pdo) {
		$sql = 'SELECT * FROM Book_List ORDER BY Book_List.bookID DESC';
		$statement = $pdo->query($sql);
		$rows = $statement->fetchAll(PDO::FETCH_ASSOC);

		if ($rows < 0) {
			echo '
			<a href="addBook.php" class="blog-post_cta" id="addPost1">Add Post</a>
			<h1 style="color:red; text-align:center; margin-top:2em;  margin-bottom:20%;">Posts a Blog to view</h1>';
		} else {
			echo '
			<a href="addBook.php" class="blog-post_cta" id="addPost">Add Post</a>';

			foreach ($rows as $row) {
				echo '
				<div class="container">
					<div class="blog-post">
						<div class="blog-post_img">
							<img src="media/'.$row['image'].'" alt="">
						</div>

						<div class="blog-post_info">
							<div class="blog-post_date">
								<span>'.$row['author'].'</span>
								<span>'.$row['date_posted'].'</span>
							</div>
							<h1 class="blog-post_title">'.$row['title'].'</h1>
							<p class="blog-post_text">'.$row['description'].'
							</p>
							<a href="#" class="blog-post_cta">Read More</a>
						</div>
					</div>
				</div>

				';
			}
		}
		$pdo = null;
		$sql = null;
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
				$_SESSION['upass'] = $user['upass'];
				$_SESSION['firstname'] = $user['firstname'];
				$_SESSION['lastname'] = $user['lastname'];
				header('Location: index.php');
			}else {
				echo '<script> alert("Invalid username or password") </script>';
			}
		} catch (Exception $e) {
			echo 'Message: '.$e->getMessage();
		}
		$pdo = null;
		$sql = null;
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

    	echo '<select name="options" id="categories">';
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
    	$pdo = null;
    	$sql = null;
    };
	



 ?>