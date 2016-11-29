<?php
require '../src/buy.php';


class CheckoutTest extends PHPUnit_Framework_TestCase
{
	
	// this test case should fail because email id is invalid
	public function testEmailID1()
	{
		$buyobj= new customerDeliveryDetails();
		$email_id="anveshgmail.com";
		$this->assertEquals(true,$buyobj->validationOfEmail($email_id));
	}
	// this test case should pass because email id is valid
	public function testEmailID2()
	{
		$buyobj= new customerDeliveryDetails();
		$email_id="anvesh@gmail.com";
		$this->assertEquals(true,$buyobj->validationOfEmail($email_id));
	}
	// this test case should fail because phone number is invalid
	public function testPhoneNumber1()
	{
		$buyobj= new customerDeliveryDetails();
		$phone_number="940220";
		$this->assertEquals(true,$buyobj->validation_phonenumber($phone_number));
	}
	// this test case should pass because phone number is valid
	public function testPhoneNumber2()
	{
		$buyobj= new customerDeliveryDetails();
		$phone_number='9402200017';
		$this->assertEquals(true,$buyobj->validation_phonenumber($phone_number));
	}
}
?>