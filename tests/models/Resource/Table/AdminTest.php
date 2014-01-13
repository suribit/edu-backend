<?php
/**
 * Created by PhpStorm.
 * User: wss-world
 * Date: 1/13/14
 * Time: 11:16 PM
 */

namespace Test\Model\Resource\Table;

use App\Model\Resource\Table\Admin;

class AdminTest extends \PHPUnit_Framework_TestCase
{
    public function testReturnsCustomerTableName()
    {
        $table = new Admin();
        $this->assertEquals('admins', $table->getName());
    }

    public function testReturnsCustomerPrimaryKey()
    {
        $table = new Admin();
        $this->assertEquals('admin_id', $table->getPrimaryKey());
    }
}