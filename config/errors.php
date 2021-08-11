<?php
/**
 * errors.php
 *
 * Error Handler
 *
 * @category   E-Wallet
 * @package    Oxygen
 * @author     Redwan Aouni <aouniradouan@gmail.com>
 * @copyright  2021 - Oxygen
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */




    define("DEV_MODE", TRUE); // if set TRUE Every error display NOTE : DON'T PUT THIS TRUE IN PRODUCTION MODE BECAUSE OF SECURITY REASONS



    if ( DEV_MODE ) {
        // Whoops Error Handler
        $whoops = new \Whoops\Run;
        $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
        $whoops->register();
        
    }else{

        ini_set('display_errors', 0);
        ini_set('display_startup_errors', 0);

    }