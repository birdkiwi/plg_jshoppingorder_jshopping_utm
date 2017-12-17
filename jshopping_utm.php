<?php
defined('_JEXEC') or die('Restricted access');
jimport('joomla.filesystem.file');
jimport('joomla.log.log');

class plgJshoppingOrderJshopping_utm extends JPlugin{

    function __construct(&$subject, $config){
        parent::__construct($subject, $config);
    }
	
	function onBeforeCreateOrder(&$order) {
        $session = JFactory::getSession();

        $utm_tags = ['utm_source', 'utm_medium', 'utm_campaign', 'utm_term', 'utm_content'];
        $utm_comment = "";

        foreach ($utm_tags as $tag) {
            $tag_val = $session->get($tag);
            if (!empty($tag_val)) {
                $utm_comment .= " $tag: $tag_val |";
            }
        }

        $order->order_add_info = $order->order_add_info . ' UTM meta info: ' . $utm_comment;
	}
}