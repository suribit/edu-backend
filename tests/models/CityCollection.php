<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     12/19/13
 */


namespace App\Model;


class CityCollection
    implements \IteratorAggregate
{
    private $_resource;

    public function __construct(Resource\IResourceCollection $resource)
    {
        $this->_resource = $resource;
    }

    public function getCity()
    {
        return array_map(
            function ($data) {
                return new City($data);
            },
            $this->_resource->fetch()
        );
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->getCity());
    }
} 