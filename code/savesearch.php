<?php

include('../db/config.php');

$title = $_POST['title'];
$editId = $_POST['editId'];
$url = $_POST['url'];
$type = $_POST['type'];
// $image = $_POST['image'];
$desc = mysqli_real_escape_string($conn ,$_POST['desc']);
$keyword = array_filter(array_unique($_POST['keyword']));

$res = array();
if($editId == '0' )
{
	if(is_uploaded_file($_FILES['image']['tmp_name'])) {
			$sourcePath = $_FILES['image']['tmp_name'];
            $target_dir = "../uploads/";
            // $target_file = $target_dir . basename($_FILES["image"]["name"]);
			$temp = explode(".", $_FILES["image"]["name"]);
			
			$filename = strtotime(date('Y-m-d h:i:s')).'.'.end($temp);
			$target_file = $target_dir . $filename ;
			$target_file = str_replace( " ", "_", $target_file );
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			move_uploaded_file($sourcePath,$target_file);
	 }
     $file_upload = "https://www.mazenet.com/dmt/uploads/".$filename;

	 $insert_details = mysqli_query($conn, "INSERT INTO `tbl_search_details`(`url`, `path`, `title`, `description`, `image`, `type`) VALUES ('$url','$file_upload','$title','$desc','$file_upload', '$type' )");
	 $last_id = mysqli_insert_id($conn);
	 
	 if($insert_details){
		 foreach($keyword as $keyvalue)
		 {
			 $insert_key = mysqli_query($conn, "INSERT INTO `tbl_search_keyword`(`search_id`, `keywords`) VALUES ('$last_id','$keyvalue')");
		 }
		 $res = array('success' => 1, 'desc' => "Saved Successfully");
	 } else {
		 $res = array('success' => 1, 'desc' => "Something went wrong");
	 }
} else {
	$file_upload = '';
	if(is_uploaded_file($_FILES['image']['tmp_name'])) {
			$sourcePath = $_FILES['image']['tmp_name'];
            $target_dir = "../uploads/";
            // $target_file = $target_dir . basename($_FILES["image"]["name"]);
			$temp = explode(".", $_FILES["image"]["name"]);
			
			$filename = strtotime(date('Y-m-d h:i:s')).'.'.end($temp);
			$target_file = $target_dir . $filename ;
			$target_file = str_replace( " ", "_", $target_file );
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			move_uploaded_file($sourcePath,$target_file);
			$file_upload = "https://www.mazenet.com/dmt/uploads/".$filename;
	 } else {
		 $file_upload = $_POST['imageone'];
	 }
	
	 $update_details = mysqli_query($conn, "UPDATE `tbl_search_details` SET `url`='$url',`path`='$file_upload',`title`='$title',`description`='$desc', `type`='$type' WHERE id = '$editId' ");
	 if($update_details){
		 $delete_keywords = mysqli_query($conn, "DELETE FROM `tbl_search_keyword` WHERE search_id = '$editId' ");
		 foreach($keyword as $keyvalue)
		 {
			 $insert_key = mysqli_query($conn, "INSERT INTO `tbl_search_keyword`(`search_id`, `keywords`) VALUES ('$editId','$keyvalue')");
		 }
		 $res = array('success' => 1, 'desc' => "Saved Successfully");
	 } else {
		 $res = array('success' => 0, 'desc' => "Something went wrong");
	 }
	
}

echo json_encode($res);


?>