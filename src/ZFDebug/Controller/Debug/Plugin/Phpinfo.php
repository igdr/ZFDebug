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
class ZFDebug_Controller_Plugin_Debug_Plugin_Phpinfo extends ZFDebug_Controller_Plugin_Debug_Plugin implements ZFDebug_Controller_Plugin_Debug_Plugin_Interface
{
    /**
     * Contains plugin identifier name
     *
     * @var string
     */
    protected $_identifier = 'phpinfo';
    
    /**
     * Create ZFDebug_Controller_Plugin_Debug_Plugin_Phpinfo
     *
     * @param string $tab
     * @paran string $panel
     * @return void
     */
    public function __construct()
    {
        //$this->_log = A1_Log::getInstance();
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
        return 'phpinfo()';
    }

    /**
     * Gets content panel for the Debugbar
     *
     * @return string
     */
    public function getPanel()
    {
        $html = '<h4>PHP Information</h4>';

        $token = md5(uniqid());
        ob_start();
        phpinfo();
        $content = ob_get_clean();
        $html .= '<div class="pre" id="'.$token.'">'.$content.'</div>';

        $html .= '<script type="text/javascript" charset="utf-8">jQuery(function(){$("div#ZFDebug_phpinfo div#'.$token.'.pre style").remove()})</script>';
        return $html;
    }
}