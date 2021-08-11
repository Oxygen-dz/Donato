<?php
/**
 * view.php
 *
 * Views Path
 *
 * @category   E-Wallet
 * @package    Oxygen
 * @author     Redwan Aouni <aouniradouan@gmail.com>
 * @copyright  2021 - Oxygen
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */


/*

=======================================================================
    Oxygen use Twig to load templates                                 *
    Developer Doc : https://twig.symfony.com/doc/2.x/api.html         *  Author : Redwan Aouni
    Front-end Doc : https://twig.symfony.com/doc/2.x/templates.html   *
=======================================================================
    
    NOTE : Don't forget to turn the debug mode OFF (false) in production mode because of security reasons.
    NOTE : Uncomment the cache if you're in production mode, that will help to optimize the performance of the Oxygen system

*/


$loader     =   new \Twig\Loader\FilesystemLoader(  dirname(__DIR__,1) . '/' . OX_template( DEFAULT_TEMPLATE ) );
$twig       =   new \Twig\Environment($loader, [
    // 'cache' =>  dirname(__DIR__,1) . '/' . $FILES_SYSTEMS['storage']['cache'],
    'debug' => true
]);

?>