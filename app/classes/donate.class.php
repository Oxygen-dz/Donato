<?php



namespace Oxygen\Donation;

/* =============================================================================================================================*/
/* =============================================================================================================================*/

/**
 * auth.class.php
 *
 * Auth class and functions
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



class DonationClass {

    /**
     * Donate Function
     *
     * This function insert the donation information to the database
     *
     * @param   String      $Amount         Donate Amount from user
     * @param   String      $Type           Type = Onetime, Monthly
     * @param   String      $UserFullname   User Fullname
     * @param   String      $UserCountry    user Country
     * @param   String      $UserPhone      User Phone Number
     * @param   String      $PayMethod      Default payment method in the system ( Default : Config/config.php )
     * 
     * @return  String      $response       Response if the payment succeced or not
     *
     * @author Redwan Aouni <aouniradouan@gmail.com>
     */

    public function Donate($Amount, $Type, $UserFullname, $UserCountry, $UserPhone, $PayMethod = DEFAULT_PAYMENT_GETWAY){

        global $database;

        $DonationUniqueID   =   OX_RandomNumber();

        OX_Paysera_OmniPay($DonationUniqueID, null, $Amount, null);

        $database->query('INSERT INTO donations', [
            'unique_id'     => $DonationUniqueID,
            'amount'        => $Amount,
            'from_user'     => $UserFullname,
            'from_country'  => $UserCountry,
            'from_phone'    => $UserPhone
        ]);

    }
    

    private function PaymentMethod (){}

}


?>