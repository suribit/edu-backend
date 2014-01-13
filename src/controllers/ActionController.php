<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     12/18/13
 */
namespace App\Controller;


class ActionController
{
    protected $_di;
    protected $_session;

    public function __construct(\Zend\Di\Di $di)
    {
        $this->_di = $di;
        $this->_session = $this->_di->get('Session');
    }

    protected function _redirect($page, $params = [])
    {
        $urlParams = ['page' => $page];
        $urlParams = array_merge($urlParams, $params);

        header('Location: /?' . \http_build_query($urlParams));
    }

    /**
     * @return bool
     */
    protected function _isPost()
    {
        return strtolower($_SERVER['REQUEST_METHOD']) == 'post';
    }

}
