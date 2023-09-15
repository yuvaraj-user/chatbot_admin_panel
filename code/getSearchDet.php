<?php

include('../db/config.php');

$id = $_POST['id'];

$sql = "select * from tbl_search_details where id = '$id'";
$query = mysqli_query($conn, $sql);
$result = [];
$keywords = [];

$html = '';
$i = 1;
while($row = mysqli_fetch_assoc($query)){
	$sql1 = "select * from tbl_search_keyword where search_id = '$id'";
	$query1 = mysqli_query($conn, $sql1);
	while($row1 = mysqli_fetch_assoc($query1)){
		$keywords[] = $row1['keywords'];
	}
	
	$result[] = array( 'result' => $row, 'keywords' => $keywords);
}

echo json_encode($result, true);

?>