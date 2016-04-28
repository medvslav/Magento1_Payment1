<?php
/**
 * Medvslav_Paym1 extension
 * 
 * NOTICE OF LICENSE
 * 
 * This source file is subject to the MIT License
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/mit-license.php
 * 
 * @category       Medvslav
 * @package        Medvslav_Paym1
 * @copyright      Copyright (c) 2016
 * @license        http://opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Medvslav_Paym1 model
 *
 * @category    Medvslav
 * @package     Medvslav_Paym1
 * @author      Medvslav
 */
class Medvslav_Paym1_Model_Paymentmethod extends Mage_Payment_Model_Method_Abstract 
{
  protected $_code  = 'medvslav_paym1';
  //protected $_formBlockType = 'medvslav_paym/form_mypaymentmethod';
  //protected $_infoBlockType = 'medvslav_paym/info_mypaymentmethod';
  protected $_isInitializeNeeded = true;


  public function getOrderPlaceRedirectUrl()
  {
    //The user is redirected to that URL after clicking on the button "Place Order" 
    //The form of the Payment Gateway will be displayed to him
    return Mage::getUrl('mypaymentmethod1/payment/redirect', array('_secure' => false));
  }
}
