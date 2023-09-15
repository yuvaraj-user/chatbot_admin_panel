<?php
include('../db/config.php');

unset($_SESSION);
session_destroy();
header("location:../index.php");

?>