<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     12/12/13
 */
namespace Test\Model;
use App\Model\QuoteItem;
use App\Model;

class QuoteItemTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateQuoteItem()
    {
        $resource = $this->getMock('\App\Model\Resource\IResourceEntity');
        $resource->expects($this->any())
            ->method('save')
            ->with($this->equalTo(['customer_id' => 5, 'session_id' => null, 'product_id' => 12, 'qty' => 1]))
            ->will($this->returnValue(42));

        $item = new QuoteItem(['customer_id' => 5, 'session_id' => null, 'product_id' => 12], $resource);
        $item->addQty(1);
        $this->assertEquals(42, $item->save());
        $this->assertEquals(42, $item->getId());
    }

    public function testCreateQuoteItemReturnFalseQty()
    {
        $resource = $this->getMock('\App\Model\Resource\IResourceEntity');
        $resource->expects($this->any())
            ->method('save')
            ->with($this->equalTo(null))
            ->will($this->returnValue(-1));

        $item = new QuoteItem(['customer_id' => 5, 'session_id' => null, 'product_id' => 12], $resource);
        $item->addQty(0);
        $this->assertEquals(-1, $item->save());
        $this->assertEquals(null, $item->getId());
    }

    public function testUpdateQtyQuoteItem()
    {
        $resource = $this->getMock('\App\Model\Resource\IResourceEntity');
        $resource->expects($this->any())
            ->method('save')
            ->with($this->equalTo(['customer_id' => 5, 'session_id' => null, 'product_id' => 12, 'qty' => 2]))
            ->will($this->returnValue(42));

        $item = new QuoteItem(['customer_id' => 5, 'session_id' => null, 'product_id' => 12, 'qty' => 1], $resource);
        $item->updateQty(1);
        $this->assertEquals(42, $item->save());
        $this->assertEquals(42, $item->getId());
    }
}