<?php

include('../db/config.php');
$username = $_POST['username'];
$password = $_POST['password'];


 $sql = "SELECT * FROM tbl_maze_users WHERE username='$username' AND password='$password'";
$result = mysqli_query($conn, $sql);

// print_r($result);
if (mysqli_num_rows($result) === 1) {
	$row = mysqli_fetch_assoc($result);
	if ($row['username'] === $username && $row['password'] === $password) {
		$_SESSION['username'] = $row['username'];
		$_SESSION['id'] = rand();
		echo $result = json_encode(array( 'status' => '1', 'message' => "" ));
	}else{
		echo $result = json_encode(array( 'status' => '0', 'message' => "" ));
	}
} else {
	echo $result = json_encode(array( 'status' => '0', 'message' => "" ));
}

?>