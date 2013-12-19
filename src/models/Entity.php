<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     11/10/13
 */
namespace App\Model;
class Entity
{
    protected $_data = array();
    protected $_resource;

    public function __construct(array $data = [], Resource\IResourceEntity $resource = null)
    {
        $this->_data = $data;
        $this->_resource = $resource;
    }

    protected function _getData($key)
    {
        return isset($this->_data[$key]) ? $this->_data[$key] : null;
    }

    public function getData($key)
    {
        return $this->_getData($key);
    }
}

