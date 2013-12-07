<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     12/8/13
 */


namespace App\Model;

use App\Model\Resource\IResourceEntity;
use App\Model\Resource\IResourceSession;
use App\Model\Customer;


class CustomerHelper {

    private $_resource;
    private $_session;

    public function __construct(IResourceEntity $resource, IResourceSession $session)
    {
        $this->_resource = $resource;
        $this->_session = $session;
    }

    public function registerCustomer($data)
    {
        $customer = new Customer($data);
        $customer->save($this->_resource);
        if ($customer->getId() != null)
        {
            $customer->load($this->_resource, $customer->getId());
            return $customer;
        }
        return null;
    }

    public function loginCustomer($data)
    {
        $customer = new Customer($data);
        $customer->check($this->_resource);
        if ($customer->getId() != null)
        {
            $customer->load($this->_resource, $customer->getId());
            $this->_session->setData('idCustomer', $customer->getId());
            return $customer;
        }
        return null;
    }

    public function checkCustomer()
    {
        if ($this->_session->getData('idCustomer'))
        {
            $customer = new Customer([]);
            $customer->load($this->_resource, $this->_session->getData('idCustomer'));
            return $customer;
        }

        return null;
    }
} 