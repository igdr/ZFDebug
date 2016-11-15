<?php
class ZFDebug_Controller_Plugin_Debug_Plugin_Controller extends ZFDebug_Controller_Plugin_Debug_Plugin implements ZFDebug_Controller_Plugin_Debug_Plugin_Interface
{
    /**
     * Contains plugin identifier name
     *
     * @var string
     */
    protected $_identifier = 'controller';

    /**
     * @var Zend_Controller_Request_Abstract
     */
    protected $_request;

    /**
     * Gets identifier for this plugin
     *
     * @return string
     */
    public function getIdentifier()
    {
        return $this->_identifier;
    }

    /**
     * Gets menu tab for the Debugbar
     *
     * @return string
     */
    public function getTab()
    {
        return ' Controller ';
    }

    /**
     * Gets content panel for the Debugbar
     *
     * @return string
     */
    public function getPanel()
    {
        $this->_request = Zend_Controller_Front::getInstance()->getRequest();
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('viewRenderer');
        
        
        $content  = '<h3>Router</h3>';
        $content .= '<div><span style="font-weight: bold;">Current:</span>&nbsp;<span>' . Zend_Controller_Front::getInstance() -> getRouter() -> getCurrentRouteName() . '</span></div>';
        $content .= '<hr />';
        $content .= '<h3>Controller</h3>';
        $content .= '<div><span style="font-weight: bold;">Module:</span>&nbsp;<span>' . $this -> _request -> getModuleName() . '</span></div>';
        $content .= '<div><span style="font-weight: bold;">Controller:</span>&nbsp;<span>' . $this -> _request -> getControllerName() . '</span></div>';
        $content .= '<div><span style="font-weight: bold;">Action:</span>&nbsp;<span>' . $this -> _request -> getActionName() . '</span></div>';
        
        $content .= '<br/><div><span style="font-weight: bold;">Routers:</span>&nbsp;</div>';
        $router = Zend_Controller_Front::getInstance()->getRouter();
        $i=0;
        $routers = array_reverse($router->getRoutes());
    	foreach ($routers as $name=>$router) {
    		$i++;
       		$content .= '<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>'.$i.' - '.$name.'</span>&nbsp;</div>';
       	}
        return $content;
    }

}