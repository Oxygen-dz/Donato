<?php

/* =============================================================================================================================*/
/* =============================================================================================================================*/

/**
 * functions.php
 *
 * Main Functions
 *
 * @category   E-Wallet
 * @package    Oxygen
 * @author     Redwan Aouni <aouniradouan@gmail.com>
 * @copyright  2021 - Oxygen
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */

/* =============================================================================================================================*/
/* =============================================================================================================================*/








/**
 * Check and include function
 *
 * This function Check if the file exist before include it and include it directly when exist
 *
 * @param   array  	$File 			The file that we want to check if exsit or not
 * @param   string  $Include   		check the $File but include another file with this var ( Default: Null ) ( Optional )
 * @return  string:bool  			return string with include function when success and bool:false when faild
 *
 * @author Redwan Aouni <aouniradouan@gmail.com>
 */

function OX_CheckInclude(string $File, string $Include = null){

	if ( file_exists( $File ) ) {
		// if the file exists then include the file
		if ( empty( $Include ) ) {
			$check = require_once $File;
		}else{
			$check = require_once $Include;
		}

	}else {
		$check = false;
	}
	return $check;
}















/**
 * Create A safe random number
 *
 * This function Create a random number between two numbers
 *
 * @param   Integer  	$Start 			Start From number (Optional) Default : 11111111111
 * @param   Integer  	$End   		 	End till Number ( Optional ) Default : 99999999999999999
 * @return  Integer  					return INTEGER with Random number between $Start & $End Number
 *
 * @author Redwan Aouni <aouniradouan@gmail.com>
 */
function OX_RandomNumber(int $Start = 11111111111 , int $End = 99999999999999999){

	return random_int($Start, $End);

}













/**
 * device detect
 *
 * This function have the capability of device detecting so that the user will redirect to the responsive template including : mobile, desktop, tablet
 *
 * @return  bool
 * TRUE 	:  	if the detected device is desktop
 * FALSE 	: 	if the detected device is mobile or tablet or any other device
**/
function OX_DeviceDetector(){

	global $agent;

	if ( $agent->isDesktop() != 1 ) {
		$DeviceDetect 	=	false; 	// is not a desktop
	}else{
		$DeviceDetect 	=	true; 	// is an desktop

	}

	return $DeviceDetect;
}












/**
 * Template Path
 *
 * This function Check if the file exsits or not and include the template base on his folder name
 *
 * @param   array  	$templateName 	The Name of the template ( Default : Oxygen )
 * @return  string  				return string with the complete path ofthe template 
 * [NOTE : You can change the template path from config/filesystems.php ]
 *
 * @author Redwan Aouni <aouniradouan@gmail.com>
 */
function OX_template($templateName = "Oxygen"){

	global $FILES_SYSTEMS;

	$DeviceDetect 	=	OX_DeviceDetector();

	if ($DeviceDetect) {

		if ( FORCE_MOBILE_TEMPLATE ) {

			$templatePath 	=	$FILES_SYSTEMS['resources']['path'] . '/' . $FILES_SYSTEMS['view']['path'] . '/' . $FILES_SYSTEMS['templates'][$templateName] . '/' . $FILES_SYSTEMS['templates_types']['Mobile'];

		}else{

			$templatePath 	=	$FILES_SYSTEMS['resources']['path'] . '/' . $FILES_SYSTEMS['view']['path'] . '/' . $FILES_SYSTEMS['templates'][$templateName] . '/' . $FILES_SYSTEMS['templates_types']['Desktop'];

		}


	}else{

		$templatePath 	=	$FILES_SYSTEMS['resources']['path'] . '/' . $FILES_SYSTEMS['view']['path'] . '/' . $FILES_SYSTEMS['templates'][$templateName] . '/' . $FILES_SYSTEMS['templates_types']['Mobile'];

	}

	return $templatePath;
}








/**
 * Upload Image
 *
 * This function upload and store and edit images with easy way
 *
 * @param   array  	$File 			The file that we want to upload in form of $_FILES[''] (Array)
 * @param   string  $StoragePath    Storage Path where we want to store the uploaded image
 * @param   string  $FileName   	File new name ( Default : Null ) ( Optional )
 * @return  array  					[  Image Name , Image Storage Path  ]
 *
 * @author Redwan Aouni <aouniradouan@gmail.com>
 */

function OX_UploadImages(array $File, string $StoragePath, string $FileName = null){

	$handle = new \Verot\Upload\Upload( $File );
	if ($handle->uploaded) {
	  	$handle->file_new_name_body 		= 	$FileName;

		$handle->process( $StoragePath );
		  if ($handle->processed) {
		  	// Image Uploaded and processed succefuly
		    $handle->clean();
		  } else {
		  	// There an error happen while uploading or processing the image
		  }
	}

	return [
		"ImageName" 	=>	$FileName,
		"ImageStorage" 	=>	$StoragePath
	];

}







function OX_SendEmail(string $To_EMAIL, string $To_USER, string $Subject, string $BodyMessage, string $BodyType = "text/html"){

	$email = new \SendGrid\Mail\Mail();
	$email->setFrom(FROM_EMAIL, FROM_USER);
	$email->setSubject($Subject);
	$email->addTo($To_EMAIL, $To_USER);
	$email->addContent($BodyType, $BodyMessage);
	$sendgrid = new \SendGrid( SENDGRID_API_KEY );
	try {
	    $response = $sendgrid->send($email);
	} catch (Exception $e) {
	    echo 'Caught exception: '. $e->getMessage() ."\n";
	}

	return $response;

}









/**
 * Send SMS
 *
 * This function Send an Short Message (SMS) to any number configured with Twilio Account
 *
 * @param   string  $SendToPhone    Send to the number with negative eg : (+213)
 * @param   string  $MessageBody   	Message Body that will be send to the number
 * @return  String  $MessageSID 	Message SID returned from TWILIO
 *
 * @author Redwan Aouni <aouniradouan@gmail.com>
 */

function OX_SendSms(string $SendToPhone, string $MessageBody){

	$client = new Twilio\Rest\Client(TWILIO_SID, TWILIO_TOKEN);
	$message = $client->messages->create(
	  	$SendToPhone, // Text this number
			  [
			    'from' => TWILIO_PHONE_NUMBER, // From a valid Twilio number
			    'body' => $MessageBody
			  ]
	);

	return $message->sid;
}









/**
 * Call a number
 *
 * This function will call any number
 *
 * @param   string  $CallToPhone    Call number with negative eg : (+213)
 * @return  array  	$MessageSID 	Message SID returned from TWILIO
 *
 * @author Redwan Aouni <aouniradouan@gmail.com>
 */

function OX_MakeCall($CallToPhone){

	$client = new Twilio\Rest\Client(TWILIO_SID, TWILIO_TOKEN);

	// Read TwiML at this URL when a call connects (hold music)
	$client->calls->create(
	  $CallToPhone, // Call this number
	  TWILIO_PHONE_NUMBER, // From a valid Twilio number
	  [
	      'url' => 'https://demo.twilio.com/docs/classic.mp3'
	  ]
	);


}










/**
 * Call a number
 *
 * This function will call any number
 *
 * @param   string  $SendToPhone    Send message to number eg : (+213777888222)
 * @param   string  $MessageBody    Message that will send to the number via Whatsapp
 * @return  String  $MessageSID 	Message SID returned from TWILIO
 *
 * @author Redwan Aouni <aouniradouan@gmail.com>
 */

function OX_SendWhatsapp(string $SendToPhone, string $MessageBody){

	$client = new Twilio\Rest\Client(TWILIO_SID, TWILIO_TOKEN);

	$message = $client->messages 
	->create("whatsapp:" . $SendToPhone, // to 
	       array( 
	           "from" => "whatsapp:" . TWILIO_WHATSAPP_NUMBER,       
	           "body" => $MessageBody
	       ) 
	); 
	 

	return $message->sid;
}












/**
 * Payment Getways OmniPay-STRIPE
 *
 * This function Pay with Stripe
 *
 * @param   Integer  $CardNumber    	Credit Card Number
 * @param   Integer  $ExpiryMonth    	Credit Card Expire Month
 * @param   Integer  $ExpiryYear   	 	Credit Card Expire Year
 * @param   Integer  $Cvv    			Credit Card CVV
 * @param   Integer  $Amount    		Credit Card Send Amount
 * @return  String   $Currency 		 	Message SID returned from TWILIO
 *
 * @author Redwan Aouni <aouniradouan@gmail.com>
 */


function OX_STRIPE_OmniPay($CardNumber, $ExpiryMonth, $ExpiryYear, $Cvv, $Amount, $Currency ){

	$gateway = Omnipay\Omnipay::create('Stripe');
	$gateway->setApiKey( STRIPE_SECRET_KEY );

	$formData = array(
		'number' => $CardNumber,
		'expiryMonth' => $ExpiryMonth,
		'expiryYear' => $ExpiryYear,
		'cvv' => $Cvv
	);
	$response = $gateway->purchase(array('amount' => $Amount, 'currency' => $Currency, 'card' => $formData))->send();

	if ($response->isRedirect()) {
	    // redirect to offsite payment gateway
	    $response->redirect();
	} elseif ($response->isSuccessful()) {
	    // payment was successful: update database
	    print_r($response);
	} else {
	    // payment failed: display message to customer
	    echo $response->getMessage();
	}


}










/**
 * Payment Getways OmniPay-AuthorizeNet
 *
 * This function Pay with AuthorizeNet
 *
 * @param   Integer  $CardNumber    	Credit Card Number
 * @param   Integer  $ExpiryMonth    	Credit Card Expire Month
 * @param   Integer  $ExpiryYear   	 	Credit Card Expire Year
 * @param   Integer  $Cvv    			Credit Card CVV
 * @param   Integer  $Amount    		Credit Card Send Amount
 * @return  String   $Currency 		 	Message SID returned from TWILIO
 *
 * @author Redwan Aouni <aouniradouan@gmail.com>
 */


function OX_AuthorizeNet_API_OmniPay($CardNumber, $ExpiryMonth, $ExpiryYear, $Cvv, $Amount, $Currency ){

	$gateway = Omnipay\Omnipay::create('AuthorizeNetApi_Api');

	$gateway->setAuthName( AUTHORIZE_AUTH_NAME );
	$gateway->setTransactionKey( AUTHORIZE_TRANSACTION_KEY );
	$gateway->setTestMode( AUTHORIZE_TEST_MODE );

	$creditCard = new Omnipay\Common\CreditCard([
	    // Swiped tracks can be provided instead, if the card is present.
	    'number' => $CardNumber,
	    'expiryMonth' => $ExpiryMonth,
	    'expiryYear' => $ExpiryYear,
	    'cvv' => $Cvv,
	    // Billing and shipping details can be added here.
	]);

	// Generate a unique merchant site transaction ID.
	$transactionId = OX_RandomNumber(100000000,999999999);
	
	$gateway->authorize([
	    'amount' => $Amount,
	    'currency' => $Currency,
	    'transactionId' => $transactionId,
	    'card' => $creditCard,

	])->send();

}









/**
 * Payment Getways OmniPay-Paysera
 *
 * This function Pay with Paysera
 *
 * @param   String  	$CustomerEmail    	Customer Email 		(Optional)
 * @param   Integer  	$Amount    			Amount 				(Optional)
 * @param   String  	$Currency   	 	Currency  			(Optional)
 * @param   Integer  	$OrderNumber    	Order Number 		(Required)
 *
 * @author Redwan Aouni <aouniradouan@gmail.com>
 */


function OX_Paysera_OmniPay($OrderNumber, $CustomerEmail = null, $Amount = null, $Currency = null){

	// Setup payment gateway
	$gateway = Omnipay\Omnipay::create('Paysera');
	$gateway->setProjectId( PAYSERA_PROJECT_ID ); // Get it from https://bank.paysera.com/en/activities
	$gateway->setPassword( PAYSERA_PROJECT_PASSWORD ); // Get it from https://bank.paysera.com/en/activities

	// Optionally to determine which order has been paid
	$orderId = $OrderNumber;

	// Example card (actually customer) data
	$card = [
	    'email' => $CustomerEmail,
	];

	// Send purchase request
	$response = $gateway->purchase(
	    [
	        'language' => 'ENG',
	        'transactionId' => $orderId,
	        'paymentMethod' => 'hanzaee',
	        'amount' => $Amount,
	        'currency' => $Currency,
	        'returnUrl' => "http://localhost/donato/payments/payments-callback.php/{$orderId}",
	        'cancelUrl' => "http://localhost/donato/payments/payments-callback.php/{$orderId}",
	        'notifyUrl' => "http://localhost/donato/payments/payments-callback.php/{$orderId}",
	        'card' => $card,
	    ]
	)->send();

	if ($response->isRedirect()) {
	    return $response->redirect();
	}

}










/**
 * Payment Getways OmniPay-Mollie
 *
 * This function Pay with Mollie
 *
 * @param   String  	$Amount    				Amount 				(Required)
 * @param   Integer  	$Currency    			Currency 			(Required)
 * @param   String  	$OrderDescription   	Currency  			(Required)
 *
 * @author Redwan Aouni <aouniradouan@gmail.com>
 */


function OX_Mollie_OmniPay($Amount, $Currency, $OrderDescription){

	$gateway = Omnipay\Omnipay::create('Mollie');
	$gateway->setApiKey( MOLLIE_API_KEY );

	$response = $gateway->purchase(
	    [
	        "amount" 		=> 	$Amount,
	        "currency" 		=> 	$Currency,
	        "description" 	=> 	$OrderDescription,
	        "returnUrl" 	=> 	"http://localhost/wallet/signup.php"
	    ]
	)->send();

	// Process response
	if ($response->isSuccessful()) {

	    // Payment was successful
	    print_r($response);

	} elseif ($response->isRedirect()) {

	    // Redirect to offsite payment gateway
	    $response->redirect();

	} else {

	    // Payment failed
	    echo $response->getMessage();
	}


}








/**
 * Payment Getways Check Status
 *
 * This function Check if the Payment getway enbaled or not from config/payment.php file
 * 
 * @author Redwan Aouni <aouniradouan@gmail.com>
 */

function OX_PaymentGetways_Status(){

  	$GetwayName = func_get_args();

	foreach (AVAILABLE_PAYMENT_GETWAYS as $GetwayName => $GetwayStatus) {
		if ( !$GetwayStatus ) {
			// Code if getway disabled
			$response = $GetwayName . " Disabled ";
		}else{
			// Code if getway enabled
			$response = $GetwayName . " Enabled ";
		}
	}
	return $response;
}






/**
 * Face Detection API
 *
 * This function Detect Faces
 *
 * @param   String  	$FaceImageURL 	Image URL that will generate a token for it
 * @return  Array  		$response   	Face Informations [ResponseCode,RequestID,FaceToken,FaceTop,FaceLeft,FaceWidth,FaceHeight]
 *
 * @author Redwan Aouni <aouniradouan@gmail.com>
 */

function OX_FaceDetection($FaceImageURL){

	// https://github.com/AmitKKhanchandani/faceplusplus
	// Face Detection Doc https://console.faceplusplus.com/documents/5679127
	$facepp     = new Amitk\Faceplusplus\Facepp(FACE_PLUSPLUS_APIKEY, FACE_PLUSPLUS_SECRETKEY);
	$params     = array(
	    'image_url'    =>   $FaceImageURL
	);
	$response   = $facepp->execute('/detect',$params);

	$response   = json_decode(json_encode($response));
	if($response->http_code == 200){
	    $data   = json_decode($response->body, true);

	    //Token Data is in the $data variable
	    $FacePlus_RequestID 	= 	$data['request_id'];
	    $FacePlus_Token 		= 	$data['faces'][0]['face_token'];
	    $FacePlus_Top 			= 	$data['faces'][0]['face_rectangle']['top'];
	    $FacePlus_Left 			= 	$data['faces'][0]['face_rectangle']['left'];
	    $FacePlus_Width 		= 	$data['faces'][0]['face_rectangle']['width'];
	    $FacePlus_Height 		= 	$data['faces'][0]['face_rectangle']['height'];

	    $response 	=	[
	    	"ResponseCode" 		=>	$response->http_code,
	    	"RequestID" 		=>	$FacePlus_RequestID,
	    	"FaceToken" 		=>	$FacePlus_Token,
	    	"FaceTop" 			=>	$FacePlus_Top,
	    	"FaceLeft" 			=>	$FacePlus_Left,
	    	"FaceWidth" 		=>	$FacePlus_Width,
	    	"FaceHeight" 		=>	$FacePlus_Height
	    ];


	}
	else{
	    //Handle if response is not 200.
	    $response 	=	[
	    	"ResponseCode" 		=>	$response->http_code,
	    	"RequestID" 		=>	$response->http_code,
	    	"FaceToken" 		=>	$response->http_code,
	    	"FaceTop" 			=>	$response->http_code,
	    	"FaceLeft" 			=>	$response->http_code,
	    	"FaceWidth" 		=>	$response->http_code,
	    	"FaceHeight" 		=>	$response->http_code   
	    ];


	}

	return $response;

}








/**
 * Face Compare API
 *
 * This function Compare between two faces and gives you the result as an array
 *
 * @param   String  	$FirstFaceToken 	Image URL that will generate a token for it
 * @param   String  	$SecondFaceToken 	Image URL that will generate a token for it
 * @param   String  	$CompareSystem 		"URL" 		: 	Just By put thge image url.
 * 											"Token" 	: 	By generate a token of every picture and compare between theme.
 * NOTE : You can use the OX_FaceDetection() function and pass the Image URL on it and the function will generate the image token easly
 * will return an array Refer to OX_FaceDetection().
 * @return  Array  		$response   		Face Informations [ResponseCode,RequestID,FaceToken,FaceTop,FaceLeft,FaceWidth,FaceHeight]
 *
 * @author Redwan Aouni <aouniradouan@gmail.com>
 */

function OX_FaceCompare($FirstFace, $SecondFace, $CompareSystem = "URL" ){
	// https://github.com/AmitKKhanchandani/faceplusplus
	// Face Compare Doc https://console.faceplusplus.com/documents/5679308
	$facepp = new Amitk\Faceplusplus\Facepp(FACE_PLUSPLUS_APIKEY, FACE_PLUSPLUS_SECRETKEY);

	switch ($CompareSystem) {
		case 'URL':
			$params = array(
			    'image_url1'   =>  $FirstFace,
			    'image_url2'   =>  $SecondFace
			);
			break;
		
		case 'TOKEN':
			$params = array(
			    'face_token1'   =>  $FirstFace,
			    'face_token2'   =>  $SecondFace
			);
			break;

		default:

			break;			
	}


	$response = $facepp->execute('/compare',$params);

	$response = json_decode(json_encode($response));
	if($response->http_code == 200){
	    $data = json_decode($response->body, true);
	    /** Data Available
	     *  confidence
	        request_id
	        time_used
	        thresholds  */

	    // Handle Confidence Level.
	    return $data['confidence'];
	}
	else{
	    //Handle if response is not 200.
	    echo htmlentities( $response->http_code );
	}


}





?>