<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     11/7/13
 */


class ElementCollection {
    private $_data = array();

    public function __construct(array $data)
    {
        $this->_data = $data;
    }

    public function getValue($key){
        return isset($this->_data[$key]) ? $this->_data[$key] : null;
    }
}
