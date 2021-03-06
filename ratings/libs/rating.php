<?php

	$response['success'] = false;
	$response['error'] = false;

	include_once( 'ip.php' );
	include_once( 'class.ManageRatings.php' );
	$init = new ManageRatings;
	if($_POST)
	{
		$id = $_POST['idBox'];
		$rate = $_POST['rate'];
	}
	$ip_address = GetUserIP();
	$existingData = $init->getItems($id);
	
	foreach($existingData as $data)
	{
		$old_total_rating = $data['TotalRatings'];
		$total_rates = $data['TotalRates'];
	}
	$current_rating = $old_total_rating + $rate;
	$new_total_rates = $total_rates + 1;
	$new_rating = $current_rating / $new_total_rates;
	
	$insert = $init->insertRatings($id,$new_rating,$current_rating,$new_total_rates,$ip_address);
	
	if($insert == 1)
	{
		$response['success'] = 'Success';
	}
	else
	{
		$response['error'] = 'Error';
	}
	echo json_encode($response);
?>