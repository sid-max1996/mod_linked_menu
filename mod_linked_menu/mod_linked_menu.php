<?php

defined('_JEXEC') or die;
require_once dirname(__FILE__) . '/helper.php';

define("ROOT_DIR", dirname(__FILE__));

$classDiv =  htmlspecialchars($params->get("class_div"), ENT_COMPAT, 'UTF-8');
$classSelectDiv = htmlspecialchars($params->get("class_select_div"), ENT_COMPAT, 'UTF-8');
$classSelectDivDrop = htmlspecialchars($params->get("class_select_div_drop"), ENT_COMPAT, 'UTF-8');
$classUlLinkMenu = htmlspecialchars($params->get("class_select_ul"), ENT_COMPAT, 'UTF-8');
// $classSelectRight = htmlspecialchars($params->get("class_select_right"), ENT_COMPAT, 'UTF-8');
$classBtLinkMenu = htmlspecialchars($params->get("class_button"), ENT_COMPAT, 'UTF-8');
$btTitle = htmlspecialchars($params->get("title_button"), ENT_COMPAT, 'UTF-8');

$aClass = htmlspecialchars($params->get("class_a"), ENT_COMPAT, 'UTF-8');
$aActClass = htmlspecialchars($params->get("class_a_act"), ENT_COMPAT, 'UTF-8');
$ulClass = htmlspecialchars($params->get("class_ul"), ENT_COMPAT, 'UTF-8');
$ulActClass = htmlspecialchars($params->get("class_ul_act"), ENT_COMPAT, 'UTF-8');


$twoMenuItems = ModLinkedMenuHelper::getTwoMenuItems($params);
$leftMenuItems = $twoMenuItems["left_menu"];
$rightMenuItems = $twoMenuItems["right_menu"];

$leftSelection = array();
for($i = 0; $i < count($leftMenuItems); $i++){
   $optionInfo = array();
   $optionInfo["id"] = $leftMenuItems[$i]->id;
   $optionInfo["title"] = $leftMenuItems[$i]->title;
   array_push($leftSelection, $optionInfo);
}

$rightSelection = array();
for($i = 0; $i < count($rightMenuItems); $i++){
   $optionInfo = array();
   $optionInfo["id"] = $rightMenuItems[$i]->id;
   $optionInfo["title"] = $rightMenuItems[$i]->title;
   $optionInfo["parentId"] = $rightMenuItems[$i]->parent_id;
   $optionInfo["flink"] = $rightMenuItems[$i]->flink;
   array_push($rightSelection, $optionInfo);
}

$layout = JModuleHelper::getLayoutPath('mod_linked_menu');
require_once $layout;
