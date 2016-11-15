<?php
/**
 * ZFDebug Zend Additions
 *
 * @category   ZFDebug
 * @package    ZFDebug_Controller
 * @subpackage Plugins
 * @copyright  Copyright (c) 2008-2009 ZF Debug Bar Team (http://code.google.com/p/zfdebug)
 * @license    http://code.google.com/p/zfdebug/wiki/License     New BSD License
 * @version    $Id$
 */

/**
 * @category   ZFDebug
 * @package    ZFDebug_Controller
 * @subpackage Plugins
 * @copyright  Copyright (c) 2008-2009 ZF Debug Bar Team (http://code.google.com/p/zfdebug)
 * @license    http://code.google.com/p/zfdebug/wiki/License     New BSD License
 */
class ZFDebug_Controller_Plugin_Debug_Plugin_Log extends ZFDebug_Controller_Plugin_Debug_Plugin implements ZFDebug_Controller_Plugin_Debug_Plugin_Interface
{
    /**
     * Contains plugin identifier name
     *
     * @var string
     */
    protected $_identifier = 'log';

    /**
     * @var A1_Log_Writer_ZFDebug
     */
    protected $_log;
    
    /**
     * Create ZFDebug_Controller_Plugin_Debug_Plugin_Log
     *
     * @param string $tab
     * @paran string $panel
     * @return void
     */
    public function __construct()
    {
    	$this->_log = new A1_Log_Writer_ZFDebug();
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
        return 'Log ('.count($this->_log->getEvents()).')';
    }

    /**
     * Gets content panel for the Debugbar
     *
     * @return string
     */
    public function getPanel()
    {
        $html = '<h4>Log Information</h4>';
        
        $events = $this -> _log -> getEvents();
        
        foreach ($events as $event) {
	        $html .= sprintf('<div class="pre"><pre><div title="%s">%s</div></pre><hr /></div>', htmlspecialchars($event['label']), Zend_Debug::dump($event['message'], null, false));
        }
        
        if (Zend_Controller_Front::getInstance()->getResponse()->isException()) {
            $full = false;
        } elseif (!empty($events)) {
        	$full = true;
        } else {
        	$full = false;
        }
        
        $full && empty($_COOKIE['ZFDebugCollapsed']) && $html .= '<script type="text/javascript" charset="utf-8">jQuery(function(){$("div#ZFDebug_log").slideDown()})</script>';
        
        return $html;
    }
}