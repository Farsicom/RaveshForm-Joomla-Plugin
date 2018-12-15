<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Editors-xtd.readmore
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
 
defined('_JEXEC') or die;
$doc = JFactory::getDocument();
$doc->addScript(JURI::root()."plugins/editors-xtd/RaveshFormBuilderEditor/RaveshFormBuilderEditor.js");
class PlgButtonRaveshFormBuilderEditor extends JPlugin
{
    protected $autoloadLanguage = true;
  
    public function onDisplay($name)
    {
        $isCRM='false';
        $isFormican='false';
        $doc = JFactory::getDocument();
        
        $lang = JFactory::getLanguage();
        $langName = $lang->getName();
                
        $doc->addScriptDeclaration("var RaveshFormLang='$langName';var RaveshFormIsCRM='$isCRM';var RaveshFormIsFormican='$isFormican'");

        $button = new JObject();
        $button->modal = false;
        $button->class = 'btn';
        $button->link = '#';
        $button->text = 'Form';
        $button->name = 'file-add';
        $button->onclick = 'showRaveshFormDialog();return false;';
        return $button;
    }
}
?>