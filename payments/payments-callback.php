<?php


//  PAYSERA CALLBACK
// Callback Page https://developers.paysera.com/en/checkout/integrations/integration-callback
if (isset ( $_GET['data'] ) ) {
		
	$params = [];
	parse_str(base64_decode(strtr($_GET['data'], ['-' => '+', '_' => '/'])), $params);
	//use $params

	$PaymentStatus 	=	$params['status'];

	switch ($PaymentStatus) {
		case 0:
			$Status 	=	"Payment has not been executed";
			break;
		
		case 1:
			$Status 	=	"Payment successful";
			break;

		case 2:
			$Status 	=	"Payment order accepted, but not yet executed";
			break;

		case 3:
			$Status 	=	"Additional payment information";
			break;

		default:
			$Status 	=	"Unknown error, retry again later!";
			break;
	}
	echo $Status;

}



?>