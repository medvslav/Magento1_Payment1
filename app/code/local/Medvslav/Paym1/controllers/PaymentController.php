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
 * My Payment Method front contrller
 *
 * @category    Medvslav
 * @package     Medvslav_Paym1
 * @author      Medvslav
 */
class Medvslav_Paym1_PaymentController extends Mage_Core_Controller_Front_Action
{
 /**
  * This method imitate the working of the Payment Method Gateway
  *
  * @access public
  * @author Medvslav
  */ 
  public function gatewayAction() 
  {
    if ($this->getRequest()->get("orderId"))
    {
      $arr_querystring = array(
        'flag' => 1, 
        'orderId' => $this->getRequest()->get("orderId")
      );
       
      Mage_Core_Controller_Varien_Action::_redirect('mypaymentmethod1/payment/response', array('_secure' => false, '_query'=> $arr_querystring));
    }
  }
  
 /**
  * The user go in this method after clicking on the button "Place order".
  * The form of the Payment Gateway will be displayed 
  *
  * @access public
  * @author Medvslav
  */    
  public function redirectAction() 
  {
    $this->loadLayout();
    $block = $this->getLayout()->createBlock('Mage_Core_Block_Template','medvslav_paym1',array('template' => 'medvslav_paym1/redirect.phtml'));
    $this->getLayout()->getBlock('content')->append($block);
    $this->renderLayout();
  }
 
 /**
  * The response from the Payment Gateway go in this method
  * We change the status of the order (Payment Success)
  * The user is redirected on the "Success page"
  *
  * @access public
  * @author Medvslav
  */   
  public function responseAction() 
  {
    if ($this->getRequest()->get("flag") == "1" && $this->getRequest()->get("orderId")) 
    {
      $orderId = $this->getRequest()->get("orderId");
      $order = Mage::getModel('sales/order')->loadByIncrementId($orderId);
      $order->setState(Mage_Sales_Model_Order::STATE_PAYMENT_REVIEW, true, 'Payment Success.');
      $order->save();
       
      Mage::getSingleton('checkout/session')->unsQuoteId();
      Mage_Core_Controller_Varien_Action::_redirect('checkout/onepage/success', array('_secure'=> false));
    }
    else
    {
      Mage_Core_Controller_Varien_Action::_redirect('checkout/onepage/error', array('_secure'=> false));
    }
  }
}
