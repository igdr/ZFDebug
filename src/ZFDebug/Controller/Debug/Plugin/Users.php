<?php
class ZFDebug_Controller_Plugin_Debug_Plugin_Users implements ZFDebug_Controller_Plugin_Debug_Plugin_Interface
{
    /**
     * Contains plugin identifier name
     *
     * @var string
     */ 
    protected $_identifier = 'users';

    
    /**
     * @var Array
     */
    protected $_count = array();
    
    /**
     * Create ZFDebug_Controller_Plugin_Debug_Plugin_Users
     *
     * @param string $tab
     * @paran string $panel
     * @return void
     */
    public function __construct()
    {
    	$handler = Zend_Session::getSaveHandler();
		$this->_count = $handler->getCountActiveSession(); 
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
        $total = $users = 0;
        foreach ($this->_count as $site => $count) {
            $total += $count['total'];
            $users += $count['users'];
        }
        return 'Пользователей '.$total.' ('.$users.')';
    }

    /**
     * Gets content panel for the Debugbar
     *
     * @return string
     */
    public function getPanel()
    {
        $html = '';
        foreach ($this->_count as $count) {
            $html .= $count['name']. ' - '.$count['total'].' ('.$count['users'].')'.'<br/>';
        }
        
        $body = Zend_Controller_Front::getInstance()->getResponse()->getBody();
        $panel = '<h4>К-во пользователей онлайн:</h4>'.$html;
        return $panel;
    }
}