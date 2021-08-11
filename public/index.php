<?php require_once dirname(__DIR__,1) . '/' . 'server.php'; ?>
<?php require_once dirname(__DIR__,1) . '/' . 'app/classes/donate.class.php'; ?>


<?php

	if ( isset( $_POST['PaymethodBTN'] ) ) {

		$Donate_amount 			=	$_POST['amount'];
		$Donate_donation_type 	=	$_POST['donation-type'];
		$Donate_fullname 		=	$_POST['fullname'];
		$Donate_country 		=	$_POST['country'];
		$Donate_phone 			=	$_POST['phone'];

		$DonateClass = new Oxygen\Donation\DonationClass;
		$DonateClass->Donate($Donate_amount, $Donate_fullname, $Donate_country, $Donate_phone);
	}
?>


<?php

$Template 	=	$twig->render("index.blade.html",
	[
		'APP_NAME' 			=>	$APP['APP_NAME'],
		'LOCALE' 			=>	$APP['LOCALE'],
		'TemplateResources' => 	OX_template( DEFAULT_TEMPLATE ),

	]
);

echo $Template;

?>
