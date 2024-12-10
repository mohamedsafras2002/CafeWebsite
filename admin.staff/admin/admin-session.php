<?php

function check_login($conn)
{

	if(isset($_SESSION['admin_id']))
	{

		$id = $_SESSION['admin_id'];
		$query = "SELECT * FROM admin WHERE admin_id = '$id' limit 1";

		$result = mysqli_query($conn,$query);
		if($result && mysqli_num_rows($result) > 0)
		{
			$user_data = mysqli_fetch_assoc($result);
			return $user_data;
		}
	}

	header("Location: admin-login.php");
	die;

}
