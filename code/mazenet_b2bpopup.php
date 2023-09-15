<?php

include('../db/config.php');
$startDate = $_POST['startDate'];
$endDate = $_POST['endDate'];


$sql = "select * from tbl_train_hire_main_page where DATE(created_on) >= '$startDate' and DATE(created_on) <= '$endDate' order by id desc";
$query = mysqli_query($conn, $sql);
$result = [];

$html = '';
$i = 1;
while($row = mysqli_fetch_array($query)){
		$html .= '<tr>
			<td>'.$i.'</td>
			<td>'.date("d-m-Y",strtotime($row["created_on"])).'</td>
			<td>'.$row['name'].'</td>
			<td>'.$row['mobile_no'].'</td>
			<td>'.$row['email'].'</td>  
			<td>'.$row['message'].'</td>
		</tr>';
$i++;
}

echo $html;
?>