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




        $doc = JFactory::getDocument();

        $url = JURI::base();//.'/components/com_mycomponent/assets/small_img.jpg';
        //$uri = dirname(__FILE__);
        //$url=dirname( 'RaveshForm_mce_button.js', __FILE__ );


        $url =(JURI::root()."plugins/editors-xtd/RaveshFormBuilderEditor/CRM_logo_black.png");



        $lang = JFactory::getLanguage();
          $doc->addScriptDeclaration("console.log('".$url."');");
        $doc->addScriptDeclaration("var languagePosted='" . $lang->getName(). "';");






       /*$parent_directory = dirname(__FILE__);
        $js = '';
        $js = $parent_directory . '\RaveshFormBuilder.js';

       // $doc->addScriptDeclaration("console.log('". 'Joomla current URI is ' . $js . "');");
        $myfile = fopen($js, "r") or die("Unable to open file!");
        $s = fread($myfile, filesize($js));
        //$doc->addScriptDeclaration($s);

        fclose($myfile);*/

       // $img = $parent_directory . '\RaveshForm_logo.png';
       // $doc->addScriptDeclaration("var IconUrlPosted='" . $img. "';");



        //../plugins/content/SpecialTextbox/images/CRM_logo_black.png

        //$css = ".button2-left .testButton {
        //            background: transparent url(/plugins/content/SpecialTextbox/images/CRM_logo_black.png) no-repeat 100% 0px;
        //        }
        //        ";
        //$doc->addStyleDeclaration($css);

        $button = new JObject();
       $button->modal = false;;
       // $button->modal = true;
        $button->class = 'btn';




        $button->link = '#';
      //  $button->options = "{handler: 'iframe', size: {x: 600, y: 400}}";

        $button->text = 'Ravesh CRM';
        // $button->text    = JText::_('Wzór przetargu do 30k');
        //$button->name = 'PrzetargiButton';
      // $button->name = 'testButton';
     //   $button->name = 'Contents';
        //  $button->name    = 'arrow-down';
        $button->name    = 'copy';
       // $button->icon    = $url;

       // $button->set('options', "{handler: 'iframe', size: {x: 400, y: 100}}");
        $button->onclick = ' showDialog();return false;';
       // $button->options = "{handler: 'iframe', size: {x: 800, y: 500}}";






        return $button;
    }
}
?>