<?php

defined('_JEXEC') or die;

class ModLinkedMenuHelper
{
    public static function getTwoMenuItems($params)
    {
        $app = JFactory::getApplication();
        $menu = $app->getMenu();

        $menutype = $params->get("menutype");
        $menuItems = $menu->getItems('menutype', $menutype);
        //print_r($menuItems);
        $leftMenuItems = array();
        $rightMenuItems = array();
        for($i = 0; $i < count($menuItems); $i++){
          if($menuItems[$i]->level == 1){
            array_push($leftMenuItems, $menuItems[$i]);
          }
          if($menuItems[$i]->level == 2){
            array_push($rightMenuItems, $menuItems[$i]);
          }
        }
        $TwoMenuItems = array();
        $TwoMenuItems["left_menu"]=$leftMenuItems;
        $TwoMenuItems["right_menu"]=$rightMenuItems;
        return $TwoMenuItems;
    }
}
