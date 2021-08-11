<?php
/**
 * security.php
 *
 * any security methid will be here 
 *
 * @category   E-Wallet
 * @package    Oxygen
 * @author     Redwan Aouni <aouniradouan@gmail.com>
 * @copyright  2021 - Oxygen
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */

use NoCSRF\NoCSRF;
// Creating a new NoCSRF instance, which manages anti-CSRF tokens.
$nocsrf = new NoCSRF();

?>