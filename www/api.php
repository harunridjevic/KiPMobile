<?php
header('Access-Control-Allow-Origin: *');
require 'img.php';

$sname= "fdb29.awardspace.net";

$unmae= "4199845_kipba";

$password = "Eaeaisis6@";

$db_name = "4199845_kipba";

$conn = mysqli_connect($sname, $unmae, $password, $db_name);


if(isset($_GET['type'])){
	if($_GET['type'] == "login"){
		$username = $_GET['username'];
		$password = $_GET['password'];
		if(isset($_GET['username'])&&isset($_GET['password'])){
			$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
			$result = mysqli_query($conn,$query);
			$totalRows = mysqli_num_rows($result);
			
			if($totalRows > 0){
				$row = mysqli_fetch_assoc($result);
							
				$_SESSION['username'] = $row['username'];

				$_SESSION['password'] = $row['password'];

				$_SESSION['id'] = $row['id'];
				echo $_SESSION['username'];
			}
			else{
				echo "undefined";
			}
		}
		else{
				echo "undefined";
		}
	}
	else if($_GET['type'] == "registration"){
		$username = $_GET['username'];
		$password = $_GET['password'];
		if(isset($_GET['username'])&&isset($_GET['password'])){
			$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
			$result = mysqli_query($conn,$query);
			$totalRows = mysqli_num_rows($result);
			
			if($totalRows === 0){
				$sql = "INSERT INTO users (username,password) VALUES ('$username','$password')";
				$result = mysqli_query($conn,$sql);
							
				$_SESSION['username'] = $row['username'];

				$_SESSION['password'] = $row['password'];

				$_SESSION['id'] = $row['id'];
				echo $_SESSION['username'];
				exit();
			}
			else{
				echo "undefined";
				exit();
			}
		}
                
		else{
				echo "undefined";
				exit();
		}
	}
	else if($_GET['type'] == "home"){
                $start = $_GET['start'];
		$limit = $_GET['limit'];
                $input = $_GET['search'];
                $category = $_GET['category'];
                if($category == ""){
                if($input !=""){
                $sql = "SELECT * FROM articles WHERE name LIKE '%$input%' LIMIT $start, $limit ";
		$result = mysqli_query($conn,$sql);
		$rows = array();
                if(mysqli_num_rows($result)<1){
                        $response = ["r" => 'reachedMax'];
                        echo json_encode($response);
                }else{
		while($r = mysqli_fetch_assoc($result)) {
                $image = 'img/'.$r['id'].'.jpg';
                $q = ["image"=>'<img width="160px" height="100px" src="data:image;base64,'.base64_encode(file_get_contents($image)).'">'];
		$rows[] = $r+$q;
                
		}

		echo json_encode($rows);
                }
                }else{
		$sql = "SELECT * FROM articles LIMIT $start, $limit";
		$result = mysqli_query($conn,$sql);
		$rows = array();
                if(mysqli_num_rows($result)<1){
                        $response = ["r" => 'reachedMax'];
                        echo json_encode($response);
                }else{
		while($r = mysqli_fetch_assoc($result)) {
                $image = 'img/'.$r['id'].'.jpg';
                $q = ["image"=>'<img width="160px" height="100px" src="data:image;base64,'.base64_encode(file_get_contents($image)).'">'];
		$rows[] = $r+$q;
                
		}

		echo json_encode($rows);
                }
                }}
                
                else{
                $sql = "SELECT * FROM articles WHERE kategorija = 'automobili' LIMIT $start, $limit";
		$result = mysqli_query($conn,$sql);
		$rows = array();
                if(mysqli_num_rows($result)<1){
                        $response = ["r" => 'reachedMax'];
                        echo json_encode($response);
                }else{
		while($r = mysqli_fetch_assoc($result)) {
                $image = 'img/'.$r['id'].'.jpg';
                $q = ["image"=>'<img width="160px" height="100px" src="data:image;base64,'.base64_encode(file_get_contents($image)).'">'];
		$rows[] = $r+$q;
                
		}

		echo json_encode($rows);
                }
                }
	}
        
        
}

else if(isset($_POST)){
        $naziv = $_POST["naziv"];
        $kategorija = $_POST["kategorija"];
        $opis = $_POST["opis"];
        $lokacija = $_POST["lokacija"];
        $cijena = $_POST["cijena"];
        $name;
        
        $sql = "INSERT INTO articles(name,kategorija,price) VALUES('$naziv','$kategorija','$cijena')";
	$result = mysqli_query($conn,$sql);
        
        $sql = "SELECT * FROM articles where name = ('$naziv')";
	$result = mysqli_query($conn,$sql);
        $r = mysqli_fetch_assoc($result);        
                
        $name = $r['id'];
        $target_dir = "img/";
        $target_file = $target_dir . $name. ".jpg";
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
              $image = new SimpleImage();
               $image->load($target_file);
                    $image->resize(160, 100);
            $image->save($target_file);
          } else {
            echo "Sorry, there was an error uploading your file.";
          }
        die();
}
else{
	echo "Invalid format";
	exit();
}
?>