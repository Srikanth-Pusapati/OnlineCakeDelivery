<?php
require '../src/Registration.php';

//Insert query should be executed before running these test cases
class RegistrationTests extends PHPUnit_Framework_TestCase
{
    
	/*Testing whether given username and username in database is same or not.
	In this testcase we are giving username as "test1" and sending the value as "test" so that this testcase would fails */
    public function test_uname1()
    {
        // Arrange
        $a = new Registration();
		$testValue = Array (
		"uname" => "test1",
		"email" => "test1@gmail.com",
		"address" => "ss",
		"pwd" => "Sri_1993",
		"mobile" => "0987654321",
		"type" => "customer" );
		//Set the form details.
		$a->setFormDetails($testValue);
		//execute the query.
		$a->executeInsertQuery();
		//assert if the errormessage is empty or not.
		$this->assertEquals("test",$a->getUname());
        
    }
	/*Testing whether given username and username in database is same or not.
	In this testcase we are giving username as "" and sending the value as "test" so that this testcase would fails */
	public function test_uname2()
    {
        // Arrange
        $a = new Registration();
		$testValue = Array (
		"uname" => "",
		"email" => "test1@gmail.com",
		"address" => "ss",
		"pwd" => "Sri_1993",
		"mobile" => "0987654321",
		"type" => "customer" );
		//Set the form details.
		$a->setFormDetails($testValue);
		//execute the query.
		$a->executeInsertQuery();
		//assert if the errormessage is empty or not.
		$this->assertEquals("test",$a->getUname());
        
    }
	/*Testing whether given username and username in database is same or not.
	In this testcase we are giving username as "test" and sending the value as "test" so that this testcase would pass */
	public function test_uname3()
    {
        // Arrange
        $a = new Registration();
		$testValue = Array (
		"uname" => "test",
		"email" => "test1@gmail.com",
		"address" => "ss",
		"pwd" => "Sri_1993",
		"mobile" => "0987654321",
		"type" => "customer" );
		//Set the form details.
		$a->setFormDetails($testValue);
		//execute the query.
		$a->executeInsertQuery();
		//assert if the errormessage is empty or not.
		$this->assertEquals("test",$a->getUname());
        
    }
	/*Testing whether given emailid and emailid in database is same or not.
	In this testcase we are giving emailid as "" and sending the value as "test@gmail.com" so that this testcase would fails */
	public function test_email1()
    {
        // Arrange
        $a = new Registration();
		$testValue = Array (
		"uname" => "test",
		"email" => "",
		"address" => "ss",
		"pwd" => "Sri_1993",
		"mobile" => "0987654321",
		"type" => "customer" );
		//Set the form details.
		$a->setFormDetails($testValue);
		//execute the query.
		$a->executeInsertQuery();
		//assert if the errormessage is empty or not.
		$this->assertEquals("test@gmail.com",$a->getEmail());
        
    }
	/*Testing whether given emailid and emailid in database is same or not.
	In this testcase we are giving emailid as "test1@gmail.com" and sending the value as "test@gmail.com" so that this testcase would fails */
	public function test_email2()
    {
        // Arrange
        $a = new Registration();
		$testValue = Array (
		"uname" => "test",
		"email" => "test1@gmail.com",
		"address" => "ss",
		"pwd" => "Sri_1993",
		"mobile" => "0987654321",
		"type" => "customer" );
		//Set the form details.
		$a->setFormDetails($testValue);
		//execute the query.
		$a->executeInsertQuery();
		//assert if the errormessage is empty or not.
		$this->assertEquals("test@gmail.com",$a->getEmail());
        
    }
	/*Testing whether given emailid and emailid in database is same or not.
	In this testcase we are giving emailid as "test@gmail.com" and sending the value as "test@gmail.com" so that this testcase would pass */
	public function test_email3()
    {
        // Arrange
        $a = new Registration();
		$testValue = Array (
		"uname" => "test",
		"email" => "test@gmail.com",
		"address" => "ss",
		"pwd" => "Sri_1993",
		"mobile" => "0987654321",
		"type" => "customer" );
		//Set the form details.
		$a->setFormDetails($testValue);
		//execute the query.
		$a->executeInsertQuery();
		//assert if the errormessage is empty or not.
		$this->assertEquals("test@gmail.com",$a->getEmail());
        
    }
	/*Testing whether given address and address  in database is same or not.
	In this testcase we are giving address  as "Bernard street" and sending the value as "Bernard street" so that this testcase would pass */
	public function test_address()
    {
        // Arrange
        $a = new Registration();
		$testValue = Array (
		"uname" => "test",
		"email" => "test1@gmail.com",
		"address" => "Bernard street",
		"pwd" => "Sri_1993",
		"mobile" => "0987654321",
		"type" => "customer" );
		//Set the form details.
		$a->setFormDetails($testValue);
		//execute the query.
		$a->executeInsertQuery();
		//assert if the errormessage is empty or not.
		$this->assertEquals("Bernard street",$a->getAddress());
        
    }
	/*Testing whether given password and password  in database is same or not.
	In this testcase we are giving password  as "" and sending the value as "Sri_1993" so that this testcase would fails */
	public function test_password1()
    {
        // Arrange
        $a = new Registration();
		$testValue = Array (
		"uname" => "test",
		"email" => "test1@gmail.com",
		"address" => "Bernard street",
		"pwd" => "",
		"mobile" => "0987654321",
		"type" => "customer" );
		//Set the form details.
		$a->setFormDetails($testValue);
		//execute the query.
		$a->executeInsertQuery();
		//assert if the errormessage is empty or not.
		$this->assertEquals("Sri_1993",$a->getPassword());
        
    }
	/*Testing whether given password and password  in database is same or not.
	In this testcase we are giving password  as "Sri1993" and sending the value as "Sri_1993" so that this testcase would fails */
	public function test_password2()
    {
        // Arrange
        $a = new Registration();
		$testValue = Array (
		"uname" => "test",
		"email" => "test1@gmail.com",
		"address" => "Bernard street",
		"pwd" => "Sri1993",
		"mobile" => "0987654321",
		"type" => "customer" );
		//Set the form details.
		$a->setFormDetails($testValue);
		//execute the query.
		$a->executeInsertQuery();
		//assert if the errormessage is empty or not.
		$this->assertEquals("Sri_1993",$a->getPassword());
        
    }
	/*Testing whether given password and password  in database is same or not.
	In this testcase we are giving password  as "Sri_1993" and sending the value as "Sri_1993" so that this testcase would pass */
	public function test_password3()
    {
        // Arrange
        $a = new Registration();
		$testValue = Array (
		"uname" => "test",
		"email" => "test1@gmail.com",
		"address" => "Bernard street",
		"pwd" => "Sri_1993",
		"mobile" => "0987654321",
		"type" => "customer" );
		//Set the form details.
		$a->setFormDetails($testValue);
		//execute the query.
		$a->executeInsertQuery();
		//assert if the errormessage is empty or not.
		$this->assertEquals("Sri_1993",$a->getPassword());
        
    }
	/*Testing whether given phone number and phone number  in database is same or not.
	In this testcase we are giving phone number  as "" and sending the value as "0987654321" so that this testcase would fails */
	public function test_mobilenum1()
    {
        // Arrange
        $a = new Registration();
		$testValue = Array (
		"uname" => "test",
		"email" => "test1@gmail.com",
		"address" => "Bernard street",
		"pwd" => "Sri_1993",
		"mobile" => "",
		"type" => "customer" );
		//Set the form details.
		$a->setFormDetails($testValue);
		//execute the query.
		$a->executeInsertQuery();
		//assert if the errormessage is empty or not.
		$this->assertEquals("0987654321",$a->getMobileNumber());
        
    }
	/*Testing whether given phone number and phone number  in database is same or not.
	In this testcase we are giving phone number  as "1987651452" and sending the value as "0987654321" so that this testcase would fails */
	public function test_mobilenum2()
    {
        // Arrange
        $a = new Registration();
		$testValue = Array (
		"uname" => "test",
		"email" => "test1@gmail.com",
		"address" => "Bernard street",
		"pwd" => "Sri_1993",
		"mobile" => "1987651452",
		"type" => "customer" );
		//Set the form details.
		$a->setFormDetails($testValue);
		//execute the query.
		$a->executeInsertQuery();
		//assert if the errormessage is empty or not.
		$this->assertEquals("0987654321",$a->getMobileNumber());
        
    }
	/*Testing whether given phone number and phone number  in database is same or not.
	In this testcase we are giving phone number  as "0987654321" and sending the value as "0987654321" so that this testcase would pass */
	public function test_mobilenum3()
    {
        // Arrange
        $a = new Registration();
		$testValue = Array (
		"uname" => "test",
		"email" => "test1@gmail.com",
		"address" => "Bernard street",
		"pwd" => "Sri_1993",
		"mobile" => "0987654321",
		"type" => "customer" );
		//Set the form details.
		$a->setFormDetails($testValue);
		//execute the query.
		$a->executeInsertQuery();
		//assert if the errormessage is empty or not.
		$this->assertEquals("0987654321",$a->getMobileNumber());
        
    }
	
	

    
}
?>








