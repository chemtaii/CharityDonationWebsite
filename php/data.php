<?php

session_start();

$connect = new PDO("mysql:host=localhost;dbname=donation_system", "root", "");

if(isset($_POST["action"]))
{

	if($_POST["action"] == 'fetch')
	{

		$query = "
		SELECT Type, SUM(Quantity) AS Total 
		FROM donations 
		GROUP BY Charity_ID
		";

		$result = $connect->query($query);

		$data = array();

		foreach($result as $row)
		{
			$data[] = array(
				'language'		=>	$row["Type"],
				'total'			=>	$row["Total"],
				'color'			=>	'#' . rand(100000, 999999) . ''
			);
		}

		echo json_encode($data);
	}

		if($_POST["action"] == 'fetch1')
	{

		$filter = $_SESSION['charname'];

		$query = "
		SELECT donations.Type, SUM(donations.Quantity), charities.User_ID AS Total 
		FROM donations JOIN charities ON charities.Charity_ID = donations.Charity_ID 
		WHERE charities.User_ID = $filter
		GROUP BY charities.Charity_ID
		";

		$result = $connect->query($query);

		$data = array();

		foreach($result as $row)
		{
			$data[] = array(
				'language'		=>	$row["Type"],
				'total'			=>	$row["Total"],
				'color'			=>	'#' . rand(100000, 999999) . ''
			);
		}

		echo json_encode($data);
	}

		if($_POST["action"] == 'fetch2')
	{

		$filter = $_SESSION['username'];

		$query = "
		SELECT donations.Type, SUM(donations.Quantity) AS Total
		FROM donations JOIN charities ON charities.Charity_ID = donations.Charity_ID 
		WHERE donations.User_ID = $filter
		GROUP BY donations.Donation_ID
		";

		$result = $connect->query($query);

		$data = array();

		foreach($result as $row)
		{
			$data[] = array(
				'language'		=>	$row["Type"],
				'total'			=>	$row["Total"],
				'color'			=>	'#' . rand(100000, 999999) . ''
			);
		}

		echo json_encode($data);
	}

}

?>