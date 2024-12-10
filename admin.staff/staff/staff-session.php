<?php

function check_login($conn)
{

	if(isset($_SESSION['staff_id']))
	{
		$id = $_SESSION['staff_id'];
		$query = "SELECT * FROM staff WHERE staff_id = '$id' limit 1";

		$result = mysqli_query($conn,$query);
		if($result && mysqli_num_rows($result) > 0)
		{
			$user_data = mysqli_fetch_assoc($result);
			return $user_data;
		}
	}

	header("Location: staff-login.php");
	die;

}
