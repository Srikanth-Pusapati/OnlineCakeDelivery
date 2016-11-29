<?php
require '../src/login.php';


class LoginTest extends PHPUnit_Framework_TestCase
{
	//checking whether admin is redirecting to correct page or not
	public function testusertype1()
	{
		$obj= new Login();
		$usertype="admin";
		$this->assertEquals("admin_features.php",$obj->redirectBrowser($usertype));
	}
	//checking whether customer is redirecting to correct page or not
	public function testusertype2()
	{
		$obj= new Login();
		$usertype="customer";
		$this->assertEquals("index_Customer_logged.php",$obj->redirectBrowser($usertype));
	}
	//checking whether deliverer is redirecting to correct page or no
	public function testusertype3()
	{
		$obj= new Login();
		$usertype="deliverer";
		$this->assertEquals("deliverer_customerOrders.php",$obj->redirectBrowser($usertype));
	}
	//checking whether admin login credentials are retreiving from login_admin table or not
	public function test_admintable()
	{
		$obj= new Login();
		$usertype="admin";
		$this->assertEquals("login_admin",$obj->getTableName($usertype));
	}
	//checking whether customer login credentials are retreiving from login_customer table or not
	public function testcustomertable()
	{
		$obj= new Login();
		$usertype="customer";
		$this->assertEquals("login_customer",$obj->getTableName($usertype));
	}
	//checking whether deliverer login credentials are retreiving from login_deliverertable or not
	public function testadmintable()
	{
		$obj= new Login();
		$usertype="deliverer";
		$this->assertEquals("login_deliverer",$obj->getTableName($usertype));
	}
}