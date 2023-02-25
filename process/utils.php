<?php
	$pdo = require '../connection.php';

	session_start();
	if (isset($_POST['addUserBtn'])) {
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$username = $_POST['username'];
		$upass1 = $_POST['upass1'];
		$upass2 = $_POST['upass2'];

		if (checkUsername($pdo, $username) == True) {
			echo '<script>alert("Username Already Exist!!")</script>';
		} else if($upass1 === $upass2) {
			$upass = $upass1;
			addUser($pdo, $username, $firstname, $lastname, $upass);
			echo '<script>alert("Register Succesfully")</script>';
		}
		else {
			echo '<script>alert("Password does not match")</script>';
			echo '<script>window.location.assign("../template/sign-up.php")</script>';
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
				addBook($pdo, $title, $author, $description, $newImageName, $categoryID, $_SESSION['userID']);
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

	if (isset($_GET['trn']) && $_GET['trn']=='DELETE'){
		$userID = $_GET['userID'];
        deleteUser($pdo, $userID);
        unset($_GET['trn']);
        unset($_GET['userID']);
        //echo '<script>window.location="admin.php"</script>';
	}elseif(isset($_GET['trn']) && $_GET['trn'] == 'DELETEBOOK') {
		$bookID = $_GET['bookID'];
		deleteBook($pdo, $bookID);
		unset($_GET['trn']);
        unset($_GET['userID']);
	}


	if (isset($_POST['addCategoryBtn'])) {
		$name = $_POST['category'];
		if (checkCategory($pdo, $name) == True) {
			echo '<script>alert("Category Already exists")</script>';
		}else{
			addCategory($pdo, $name);
		}
	}

	if (isset($_POST['deletePostBtn'])) {
		deletePost($pdo, $_POST['bookID']);
	}





    function checkCategory($pdo, $name) {
    	try {
    		$sql = 'SELECT count(name) as rowCount FROM Categories where name=:name';
    		$statement = $pdo->prepare($sql);
    		$statement->bindValue(':name', $name);
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





	function populateUser($pdo) {
		
			$sql = 'SELECT * FROM User_List';
			$statement = $pdo->query($sql);
			$rows = $statement->fetchAll(PDO::FETCH_ASSOC);

			foreach ($rows as $row) {
				$userID = $row['userID'];
				echo '<tr class="active-row">
					<td>'.$row['userID'].'</td>
					<td>'.$row['username'].'</td>
					<td>'.$row['firstname'].'</td>
					<td>'.$row['lastname'].'</td>
					<td>'.$row['upass'].'</td>
					<td>
						<a href="javascript:UpdateUser('."'$userID'".');" data-toggle="tooltip" title="Update">
                                <button type="button" class="btn btn-primary">Update</button>
                        </a>
                        <a href="javascript:DeleteUser('."'$userID'".');" data-toggle="tooltip" title="Delete">
                            <button type="button" class="btn btn-primary">Delete</button>
                        </a>
					</td>
					</tr>
					';
		}
	}


	function populateBook($pdo) {
		
			$sql = 'SELECT Book_List.*, Categories.name, User_List.* FROM Book_List JOIN Categories ON Book_List.categoryID = Categories.categoryID JOIN User_List ON Book_List.userID = User_List.userID ORDER BY Book_List.bookID DESC;';
			$statement = $pdo->query($sql);
			$rows = $statement->fetchAll(PDO::FETCH_ASSOC);

			foreach ($rows as $row) {
				$bookID = $row['bookID'];
				echo '<tr class="active-row">
					<td>'.$row['bookID'].'</td>
					<td>'.$row['userID'].'</td>
					<td>'.$row['title'].'</td>
					<td>'.$row['author'].'</td>
					<td>'.$row['name'].'</td>
					<td>'.$row['username'].'</td>
					<td>'.$row['firstname'].'</td>
					<td>'.$row['lastname'].'</td>
					<td>
						<a href="javascript:UpdateUser('."'$bookID'".');" data-toggle="tooltip" title="Update">
                                <button type="button" class="btn btn-primary">Update</button>
                        </a>
                        <a href="javascript:DeleteBook('."'$bookID'".');" data-toggle="tooltip" title="Delete">
                            <button type="button" class="btn btn-primary">Delete</button>
                        </a>
					</td>
					</tr>
					';
		}
	}



	function deleteBook($pdo, $bookID) {
		try{

			$sql = 'SELECT image FROM Book_List WHERE bookID=:bookID';
			$statement = $pdo->prepare($sql);
		    $statement->bindValue(':bookID', $bookID);
		    $statement->execute();
		    $result = $statement->fetch(PDO::FETCH_ASSOC);
		    $imageFilePath = $result['image'];
			$path = 'media/'.$imageFilePath;


			unlink($path);

			$sql = 'DELETE FROM Book_List WHERE bookID=:bookID';
			$statement = $pdo->prepare($sql);
			$statement->bindValue(':bookID', $bookID);
			$statement->execute();


	        echo '<script>alert("Book deleted successfully");
	        	location.reload();
	        </script>';
	        header('Location: admin.php');

    	}catch(Exception $e){
    		echo 'Message: '.$e->getMessage();
    	}
        $pdo = null;
        $sql = null;
	}





	function deleteUser($pdo, $userID) {
		try{

			$sql = "DELETE FROM Book_List WHERE userID = :userID";
			$statement = $pdo->prepare($sql);
			$statement->bindValue(':userID', $userID);
			$statement->execute();

			$sql = 'DELETE FROM User_List WHERE userID=:userID';
			$statement = $pdo->prepare($sql);
			$statement->bindValue(':userID', $userID);
	        $statement->execute();
	        echo '<script>alert("User deleted successfully")</script>';
    	}catch(Exception $e){
    		echo 'Message: '.$e->getMessage();
    	}
        $pdo = null;
        $sql = null;
	}


	function updateUser($pdo, $userID ,$username, $firstname, $lastname, $upass) {
		$sql = 'UPDATE User_List SET username=:username, firstname=:firstname, lastname=:lastname, upass=:upass WHERE userID=:userID';
		$statement = $pdo->prepare($sql);
		$statement->bindValue(':userID',$userID);
		$statement->bindValue(':username', $username);
		$statement->bindValue(':firstname', $firstname);
		$statement->bindValue(':lastname', $lastname);
		$statement->bindValue(':upass', $upass);
		$statement->execute();
		
		echo '<script>alert("Update Succesfully");
        window.location.assign("admin.php")
        </script>';
        $pdo = null;
        $sql = null;
	}


	function getUserInfo($pdo, $userID) {
		$sql = 'SELECT * FROM User_List WHERE userID = :userID';
		$statement = $pdo->prepare($sql);
		$statement->bindValue(':userID', $userID);
		$statement->execute();

		$row = $statement->fetch(PDO::FETCH_ASSOC);
		$userID = $row['userID'];
		$username = $row['username'];
		$firstname = $row['firstname'];
		$lastname = $row['lastname'];
		$upass = $row['upass'];

		return ['userID'=>$userID,'username'=>$username, 'firstname'=>$firstname, 'lastname'=>$lastname, 'upass'=>$upass];

        $pdo = null;
        $sql = null;
            
	}





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
		$sql = 'SELECT Book_List.*, Categories.name, User_List.* FROM Book_List JOIN Categories ON Book_List.categoryID = Categories.categoryID JOIN User_List ON Book_List.userID = User_List.userID ORDER BY Book_List.bookID DESC;';
		$statement = $pdo->query($sql);
		$rows = $statement->fetchAll(PDO::FETCH_ASSOC);

		if (count($rows) <= 0) {
			echo '<h1 class="noResult">No books</h1>';
			echo '<a href="addBook.php" class="blog-post_cta" id="addPost1">Add Post</a>';
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
								<span>Author: '.$row['author'].'</span>
								<span>Genre: '.$row['name'].'</span>
								
								<span>'.$row['date_posted'].'</span>
							</div>
							<h1 class="blog-post_title">'.$row['title'].'</h1>
							<p class="blog-post_text">'.$row['description'].'
							<p class="blog-post_text" style="color:RGB(146, 168, 209);">Posted by: '.$row['firstname'].' '.$row['lastname'].'</p>
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




	function myPosts($pdo, $userID) {
		$sql = 'SELECT Book_List.*, Categories.name, User_List.* FROM Book_List JOIN Categories ON Book_List.categoryID = Categories.categoryID JOIN User_List ON Book_List.userID = User_List.userID WHERE Book_List.userID = :userID ORDER BY Book_List.bookID DESC;';
		$statement = $pdo->prepare($sql);
		$statement->bindValue(':userID', $userID);
		$statement->execute();
		$rows = $statement->fetchAll(PDO::FETCH_ASSOC);

		if (count($rows) <= 0) {
			echo '<h1 class="noResult">No Posts</h1>';
			echo '<a href="addBook.php" class="blog-post_cta" id="addPost1">Add Post</a>';
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
								<span>Author: '.$row['author'].'</span>
								<span>Genre: '.$row['name'].'</span>
								
								<span>'.$row['date_posted'].'</span>
							</div>
							<h1 class="blog-post_title">'.$row['title'].'</h1>
							<p class="blog-post_text">'.$row['description'].'
							<p class="blog-post_text" style="color:RGB(146, 168, 209);">Posted by: '.$row['firstname'].' '.$row['lastname'].'</p>
							</p>
							<a href="#" class="blog-post_cta">Read More</a>
							<form method="post" style="display:inline;">
								<input type="hidden" name="bookID" value="'.$row['bookID'].'">
								<button type="submit" class="blog-post_cta" name="deletePostBtn">Delete Post</button>
							</form>
						</div>
					</div>
				</div>

				';
			}
		}
		$pdo = null;
		$sql = null;
	};




	function deletePost($pdo, $bookID) {
		$sql = 'SELECT image FROM Book_List WHERE bookID=:bookID';
		$statement = $pdo->prepare($sql);
		$statement->bindValue(':bookID', $bookID);
		$statement->execute();
		$result = $statement->fetch(PDO::FETCH_ASSOC);
		$imageFilePath = $result['image'];
		$path = 'media/'.$imageFilePath;


		unlink($path);

		$sql = 'DELETE FROM Book_List WHERE bookID=:bookID';
		$statement = $pdo->prepare($sql);
		$statement->bindValue(':bookID',$bookID);
        $statement->execute();
        echo '<script>alert("Post deleted successfully")</script>';
        $pdo = null;
        $sql = null;
	}


	function checkUser($pdo, $username, $upass) {
		try {
			$sql = 'SELECT * FROM User_List WHERE username=?';
			$statement = $pdo->prepare($sql);
			$statement->execute([$username]);
			$user = $statement->fetch();

			if ($user && $user['upass']) {
				session_start();
				$_SESSION['logged_in'] = true;
				$_SESSION['username'] = $username;
				$_SESSION['upass'] = $user['upass'];
				$_SESSION['userID'] = $user['userID'];
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







    function addBook($pdo, $title, $author, $description, $image, $categoryID, $userID) {
    	try {
	        $sql = 'INSERT INTO Book_List (title, author, description, image, categoryID, userID) VALUES (:title, :author, :description, :image, :categoryID, :userID)';
	        $statement = $pdo->prepare($sql);
	        $statement->bindValue(':title', $title);
	        $statement->bindValue(':author', $author);
	        $statement->bindValue(':description', $description);
	        $statement->bindValue(':image', $image);
	        $statement->bindValue(':categoryID', $categoryID, PDO::PARAM_INT); // specify parameter type
	        $statement->bindValue(':userID', $userID, PDO::PARAM_INT); // specify parameter type
	        $statement->execute();
	        $lastInsertId = $pdo->lastInsertId();
	        echo "Book added with ID: " . $lastInsertId;
	    } catch(PDOException $e) {
	        echo "Error adding book: " . $e->getMessage();
	    }
    	$pdo = null;
    	$sql = null;
    };



    function addCategory($pdo, $name) {
    	$sql = 'INSERT INTO Categories (name) VALUES (:name)';
    	$statement = $pdo->prepare($sql);
    	$statement->bindValue(':name', $name);
    	$statement->execute();

    	$pdo = null;
    	$sql = null;
    }


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