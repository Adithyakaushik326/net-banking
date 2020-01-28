<?php
	$conn = mysqli_connect("localhost", "root", "", "bank");
	$branch = $_POST['b'];
	$que = "SELECT emp_name, designation, emp_img ,email FROM employee, branch WHERE employee.branch_id = branch.branch_id AND branch.location = '$branch'";
	$res = mysqli_query($conn, $que);
	$data = array();
	while($row = mysqli_fetch_assoc($res)){
		$data[] = $row;
	}
	$res = json_encode($data);
	print_r($res);
?>