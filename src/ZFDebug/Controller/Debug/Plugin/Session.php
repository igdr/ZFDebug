<?php
/**
 * ZFDebug Zend Additions
 *
 * @category   ZFDebug
 * @package    ZFDebug_Controller
 * @subpackage Plugins
 * @copyright  Copyright (c) 2008-2009 ZF Debug Bar Team (http://code.google.com/p/zfdebug)
 * @license    http://code.google.com/p/zfdebug/wiki/License     New BSD License
 * @version    $Id: $
 */

/**
 * @category   ZFDebug
 * @package    ZFDebug_Controller
 * @subpackage Plugins
 * @copyright  Copyright (c) 2008-2009 ZF Debug Bar Team (http://code.google.com/p/zfdebug)
 * @license    http://code.google.com/p/zfdebug/wiki/License     New BSD License
 */
class ZFDebug_Controller_Plugin_Debug_Plugin_Session extends ZFDebug_Controller_Plugin_Debug_Plugin implements ZFDebug_Controller_Plugin_Debug_Plugin_Interface
{
    /**
     * Contains plugin identifier name
     *
     * @var string
     */
    protected $_identifier = 'session';

    /**
     * Contains Zend_Registry
     *
     * @var Zend_Registry
     */
    protected $_session;

    /**
     * Create ZFDebug_Controller_Plugin_Debug_Plugin_Session
     *
     * @return void
     */
    public function __construct()
    {   
    	Zend_Session::start(true);
    	$this->_session = $_SESSION;
    	/*foreach ($_SESSION as $k=>$v) {
            $this->_session[$k] = $v;
    	}*/
        unset($this->_session['ZFDebug_Time']);
    }

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
        return ' Session (' . count($this->_session) . ')';
    }

    /**
     * Gets content panel for the Debugbar
     *
     * @return string
     */
    public function getPanel()
    {
    	$html = '<h4>Session Instances</h4>';
    	//$this->_session->ksort();

        $html .= $this->_cleanData($this->_session);
        return $html;
    }

}