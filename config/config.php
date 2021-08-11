<?php
/**
 * config.php
 *
 * configurations
 *
 * @category   E-Wallet
 * @package    Oxygen
 * @author     Redwan Aouni <aouniradouan@gmail.com>
 * @copyright  2021 - Oxygen
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */


    define("DEFAULT_TEMPLATE", "Skyline");    // Default Template Folder Name
    define("DEFAULT_PAYMENT_GETWAY", "PAYSERA");    // Default Payment Method
    define("FORCE_MOBILE_TEMPLATE", TRUE);   // if set TRUE will show the mobile template even the detecting device is not a mobile! 


    // TWILIO SMS/VOICE Account
    define("TWILIO_SID", null);   // Your Account SID from www.twilio.com/console
    define("TWILIO_TOKEN", null);   // Your Auth Token from www.twilio.com/console
    define("TWILIO_PHONE_NUMBER", null);                // Your Phone Number from www.twilio.com/console
    // Twilio WhatApp Service
    define("TWILIO_WHATSAPP_NUMBER", null);             // Your WhatsApp Number from www.twilio.com/console




    /* 
      FaceAPP [Face++ Service] Api's
      Create FREE api type if you want to TEST and STANDARD for Production
      API KEY & SECRET KEY USED FOR ALL Face++ Services
    */
    define("FACE_PLUSPLUS_APIKEY", null);      // From https://console.faceplusplus.com/app/apikey/list
    define("FACE_PLUSPLUS_SECRETKEY", null);   // From https://console.faceplusplus.com/app/apikey/list

    // Face Compare Parametres
    define("FACE_PLUS_PROB_HEIGH_FROM", 80);
    define("FACE_PLUS_PROB_LOW_FROM", 50);

?>