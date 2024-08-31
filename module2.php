<?php

include"init.php";
$select = mysqli_query($con, "SELECT * FROM attendance  where module = 'BUSINESS' AND type = 'false'");

if (mysqli_num_rows($select) > 0) {
	$query = mysqli_query($con, "UPDATE attendance SET type = 'true' where module = 'BUSINESS'");
if ($query) {
	header("location:sms.php");
}else{
	echo "not confirmed!, try again";
}
}else{
	echo "

	<script>

	alert('there is no business attendence uploaded');
	window.location.href='confirm.php';
	</script>

	";
}



?>