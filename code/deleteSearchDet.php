<?php

include('../db/config.php');

$id = $_POST['id'];
$update_details = mysqli_query($conn, "UPDATE `tbl_search_details` SET `status`='0' WHERE id = '$id' ");
	 
?>