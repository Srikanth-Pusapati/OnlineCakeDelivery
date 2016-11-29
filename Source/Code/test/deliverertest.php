<?php
require '../src/deliverer_customerOrders.php';


class DelivererTest extends PHPUnit_Framework_TestCase
{
	// checking whether pending orders are retreiving or not
	public function testorders()
	{
		$obj= new Customer_Orders();
		$connection_object= $obj -> connectToDatabase();
		$result= $obj -> pending_Orders($connection_object);
		$this->assertGreaterThan(0,$result -> num_rows);
	}
}