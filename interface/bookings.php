<?php
	//TABLET REQUEST CHECK BOOKING

	require 'dbcred.php';

	$response = [
		'payload' => [
			'numFound' => 0,
			'bookings' => []
		]
	];

	if(isset($_GET['pin']) && isset($_GET['venue_id']) && isset($_GET['device_id'])) {
		$pin 	= urldecode($_GET['pin']);
		$venue 	= urldecode($_GET['venue_id']);
		$oche  	= urldecode($_GET['device_id']);
		if(isset($_GET['d'])) {
			$date 	= urldecode($_GET['d']);
		} else {
			$date = date('Y-m-d');
		}


		$stmt = $db->prepare("SELECT * FROM p2p_sessions WHERE (pin=? OR id=?) AND venue=? AND oche=? AND DATE(start_time) = ? AND cancelled=FALSE ORDER BY start_time DESC LIMIT 1");
		$stmt->execute([$pin, $pin, $venue, $oche, $date]); 
		$dbresult = $stmt->fetch();

		// echo '<pre>'; print_r($dbresult); echo '</pre>';

		if($dbresult) {

			$datetime = date_create($dbresult['start_time']);

			$date = date_format($datetime, 'm/d/Y');

			$time = date_format($datetime, 'H:i');

			$premium = $dbresult['premium'] ? true : false;

			$response['payload']['numFound'] = 1;

			$response['payload']['bookings'][] = [

				'booking_id' => $dbresult['pin'],
				'date'		 => $date,
				'time'       => $time,
				'duration'   => $dbresult['duration'],
				'venue_id'   => $dbresult['venue'],
				'unique_id'  => $dbresult['id'],

				'first_name' => $dbresult['name'],
				'last_name'  => $dbresult['last_name'],
				'num_people' => $dbresult['num_guests'],

				'premium'    => $premium,

				'status'     => 'complete'

			];
		}
	}

	
	echo json_encode($response);
?>