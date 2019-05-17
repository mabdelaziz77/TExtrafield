<?php

/**
 * @version		1.0
 * @package		TExtrafield (K2 plugin)
 * @author    JoomReem - http://www.joomreem.com
 * @copyright	Copyright (c)  2015 JoomReem. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */
// no direct access
defined('_JEXEC') or die('Restricted access');

// Load the K2 Plugin API
JLoader::register('K2Plugin', JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_k2' . DS . 'lib' . DS . 'k2plugin.php');
//JLoader::register('K2ModelExtraField', JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_k2' . DS . 'models' . DS . 'extrafield.php');

// Initiate class to hold plugin events
class plgK2TExtrafield extends K2Plugin {

    // Some params
    var $pluginName = 'textrafield';
    var $pluginNameHumanReadable = 'TExtrafield';

    function plgK2TExtrafield( $subject, $params) {
        parent::__construct($subject, $params);
    }

    /**
     * Below we list all available FRONTEND events, to trigger K2 plugins.
     * Watch the different prefix "onK2" instead of just "on" as used in Joomla! already.
     * Most functions are empty to showcase what is available to trigger and output. A few are used to actually output some code for example reasons.
     */
    function onK2BeforeDisplay($item, $params, $limitstart) {
        $mainframe = JFactory::getApplication();
        return '';
    }

    function onK2AfterDisplay($item, $params, $limitstart) {
        $mainframe = JFactory::getApplication();
        return '';
    }

    function onK2PrepareContent($item, $params, $limitstart) {
        $view = JRequest::getString('view');
        // Get the K2 plugin params (the stuff you see when you edit the plugin in the plugin manager)
        $plugin = JPluginHelper::getPlugin('k2', $this->pluginName);
        if(K2_JVERSION == '15') $pluginParams = new JParameter($plugin->params);
        else $pluginParams = new JRegistry($plugin->params);
        
        if ($view == 'item' || $view == 'itemlist'){
            $mainframe = JFactory::getApplication();            
            
            if($item->text){
                $regex	  = '/{extrafield+(.*?)}/i';
                preg_match_all($regex, $item->text, $matches, PREG_SET_ORDER);
                if($matches) {
                    foreach($matches as $match){
                        $fieldAlias = trim($match[1]);
                        if(isset($item->extraFields->$fieldAlias->value)){
                            $item->text = str_replace($match[0], $item->extraFields->$fieldAlias->value, $item->text);
                        }else { 
                            $item->text = str_replace($match[0], '', $item->text);
                        }
                    }
                }                
            }                                                
            return '';
        }
    }

    function onK2AfterDisplayTitle($item, $params, $limitstart) {
        $mainframe = JFactory::getApplication();
        return '';
    }

    function onK2BeforeDisplayContent($item, $params, $limitstart) {
        $mainframe = JFactory::getApplication();
        return '';
    }

    function onK2AfterDisplayContent($item, $params, $limitstart) {
        $mainframe = JFactory::getApplication();
        return '';
    }

    function onK2CategoryDisplay( $category,  $params, $limitstart) {
        $mainframe = JFactory::getApplication();
        return '';
    }

    function onK2UserDisplay( $user,  $params, $limitstart) {
        $mainframe = JFactory::getApplication();
        return '';
    }
    
}// END CLASS
