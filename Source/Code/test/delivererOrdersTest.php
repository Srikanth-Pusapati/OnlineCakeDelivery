<?php
require '../src/deliverer_selectedOrder.php';


class DelivererOrdersTest extends PHPUnit_Framework_TestCase
{
	// checking whether pending orders are retreiving or not
	public function testdelivererorders()
	{
		$obj= new SelectedOrder();
		$conn = $obj->connectToDatabase();
		$deliverer_id=3;
		$result= $obj -> confirmedOrderResults($deliverer_id,$conn);
		$this->assertGreaterThan(0,$result -> num_rows);
	}
}
?>