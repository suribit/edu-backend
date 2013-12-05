<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     12/5/13
 */
namespace Test\Model\Resource\Table;

use App\Model\Resource\Table\Product;

class ProductTest extends \PHPUnit_Framework_TestCase
{
    public function testReturnsProductTableName()
    {
        $table = new Product;
        $this->assertEquals('products', $table->getName());
    }

    public function testReturnsProductPrimaryKey()
    {
        $table = new Product;
        $this->assertEquals('product_id', $table->getPrimaryKey());
    }
}