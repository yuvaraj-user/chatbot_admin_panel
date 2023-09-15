<?php

if( isset($_SESSION) && isset($_SESSION['username']) && isset($_SESSION['id']) ){
} else {
	header("location:index.php");
}
?>