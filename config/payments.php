<?php
/**
 * Payments.php
 *
 * Payment Getways Manual Configuration
 *
 * @category   E-Wallet
 * @package    Oxygen
 * @author     Redwan Aouni <aouniradouan@gmail.com>
 * @copyright  2021 - Oxygen
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */


	$PaymentGetways = [

		"Modes" => [
			"STRIPE" 	=> 	false,
			"PAYSERA" 	=> 	false,
			"MOLLIE" 	=> 	false
		]

	];


	// DEFAULT PAYMENT MODE
	define("DEFAULT_OMNI_PAYMENT_GETWAY", "STRIPE");

	// DEFAULT PAYMENT MODE From $PaymentGetways[]
	define("AVAILABLE_PAYMENT_GETWAYS", $PaymentGetways["Modes"] );

	// Stripe Config
	define("STRIPE_SECRET_KEY", null);

	// AuthorizeNet Config
	define("AUTHORIZE_AUTH_NAME", null);
	define("AUTHORIZE_TRANSACTION_KEY", null);
	define("AUTHORIZE_TEST_MODE", TRUE);

	// Paysera Config
	define("PAYSERA_PROJECT_ID" , null); // From https://bank.paysera.com/en/activities
	define("PAYSERA_PROJECT_PASSWORD" , null); // From https://bank.paysera.com/en/activities

	// Mollie Config
	define("MOLLIE_API_KEY", null); // From https://www.mollie.com/dashboard/developers/api-keys
	


?>