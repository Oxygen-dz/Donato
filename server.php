<?php
/* =============================================================================================================================*/
/* =============================================================================================================================*/

/**
 * server.php
 *
 * Main file requirments
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


	// include autoload file and load all dependencies
	require_once __DIR__ .  '/' . 'vendor/autoload.php';

	// Errors Handler
	require_once __DIR__ .  '/' . 'config/errors.php';

	// File Systems
	require_once __DIR__ .  '/' . 'config/filesystems.php';

	// Configurations
	require_once __DIR__ .  '/' . 'config/config.php';

	// Utilities & Uses
	require_once __DIR__ .  '/' . 'config/utilities.php';

	// Databse connection
	require_once __DIR__ .  '/' . 'config/database.php';

	// Security
	require_once __DIR__ .  '/' . 'config/security.php';
	
	// Main APP CONF
	require_once __DIR__ .  '/' . 'config/app.php';

	// Email Config
	require_once __DIR__ .  '/' . 'config/email.php';


	// Payment Configurations
	require_once __DIR__ .  '/' . 'config/payments.php';


	// // Codes functions
	 require_once __DIR__ .  '/' . 'app/main/functions.php';

	// View Structures
	require_once __DIR__ .  '/' . 'config/view.php';

?>