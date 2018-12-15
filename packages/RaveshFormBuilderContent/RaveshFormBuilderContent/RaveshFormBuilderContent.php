<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Editors-xtd.readmore
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;


class plgContentRaveshFormBuilderContent extends JPlugin
{

    protected $autoloadLanguage = true;


  function onContentPrepare($context,$article,$params,$limitstart){

      $doc = JFactory::getDocument();

     $pieces = explode("]", $article->text);

      $arrlength=count($pieces);


      // echo strpos("I love php, I love php too!","php");

      $serchText="";
      $replaceText="";
      for($i=0;$i<$arrlength;$i++)
      {
          $j = strpos($pieces[$i],"[RaveshForm");
          if($j>=1){


             $x= explode("[RaveshForm", $pieces[$i]);
              $serchText="[RaveshForm".$x[1]."]";
             // echo $x;
            //  echo "<br>";
              //$doc->addScriptDeclaration("console.log('".$x[1]."');");
              $df =explode(" ", $x[1]);
              $server=explode("=", $df[1])[1];
              $server=str_replace("\"", "",$server);
              $server=trim($server);

              $domain=explode("=", $df[2])[1];
              $domain=str_replace("\"", "",$domain);
              $domain=trim($domain);

              $formid=explode("=", $df[3])[1];
              $formid=str_replace("\"", "",$formid);
              $formid=trim($formid);

              $type=explode("=", $df[4])[1];
              $type=str_replace("\"", "",$type);
              $type=trim($type);

              $title=explode("=", $df[5])[1];
              $title=str_replace("\"", "",$title);
              $title=trim($title);


              //$server= substr( $server,1);
             // $doc->addScriptDeclaration("console.log(' ".$server."');");



                if (substr($server, -1) != "/")
                {
                    $server = $server . "/";
                }
              $scriptUrl = $server . "pages/formbuilder/ravesh-formbuilder.js";
              $formUrl = $server . $domain . "/formView/" . $formid;
              $doc->addScriptDeclaration("console.log(' ".$formUrl."');");
              $result = "";
              if ($type == "inline") {
                  $result .= "<script type=\"text/javascript\" src=\"" . $scriptUrl . "\" form-url=\"" . $formUrl . "\" form-style=\"inline\"></script>";
              } else if ($type == "dialog") {
                  $result .= "<script type=\"text/javascript\" src=\"" . $scriptUrl . "\" form-url=\"" . $formUrl . "\" form-style=\"dialog\" form-link-text=\"" . $title . "\"></script>";
              } else if ($type == "fab") {
                  $result .= "<script type=\"text/javascript\" src=\"" . $scriptUrl . "\" form-url=\"" . $formUrl . "\" form-style=\"fab\" form-link-text=\"" . $title . "\" form-button-color=\"#3f51b5\" form-button-icon=\"" . $server . "/pages/formbuilder/images/send-icon.png\"></script>";
              } else if ($type == "link") {
                  $result .= "<a href=\"" . $formUrl . "\" target=\"_blank\">" . $title . "</a>";
              }
              $replaceText = "\n<!--START---- RAVESH FORM BUILDER ---- RAVESHCRM.IR ----->\n" . $result . "\n<!--END--- RAVESH FORM BUILDER ---- RAVESHCRM.IR ----->\n";

          }

      }

    //  $doc->addScriptDeclaration("console.log('".$pieces."');");


     //$t= replaceShortCode("[RaveshForm server=\"dsf\" domain=\"sdf\" formid=\"df\" type=\"inline\" title=\"مشاهده‌ی فرم\" ]");


      // Expression to search for (positions)
      //$regex = '/[RaveshForm server\s(.*?)]/i';
     // $style = $this->params->def('RaveshForm server', 'none');

     $doc->addScriptDeclaration("console.log('".$serchText."');");
    //  $doc->addScriptDeclaration("console.log('".$replaceText."');");




    //  $article->text=str_replace('[RaveshForm server','sdfsdfsdf',
    //      $article->text);
      //$replaceText="Dsfsd";
        $article->text=str_replace($serchText,$replaceText,
            $article->text);

      return false;
  }
  /* public $server='server';
  public $domain="domain";
  public $formid="id";
public $type="inline";
   function replaceShortCode($atts)
    {
        extract(shortcode_atts(array(
            "server" => 'http://',
            "domain" => '',
            "formid" => '0',
            "type" => 'inline',
            "title" => 'مشاهده‌ی فرم'
        ), $atts));

        if (substr($server, -1) != "/") $server = $server . "/";
        $scriptUrl = $server . "pages/formbuilder/ravesh-formbuilder.js";
        $formUrl = $server . $domain . "/formView/" . $formid;

        $result = "";
        if ($type == "inline") {
            $result .= "<script type=\"text/javascript\" src=\"" . $scriptUrl . "\" form-url=\"" . $formUrl . "\" form-style=\"inline\"></script>";
        } else if ($type == "dialog") {
            $result .= "<script type=\"text/javascript\" src=\"" . $scriptUrl . "\" form-url=\"" . $formUrl . "\" form-style=\"dialog\" form-link-text=\"" . $title . "\"></script>";
        } else if ($type == "fab") {
            $result .= "<script type=\"text/javascript\" src=\"" . $scriptUrl . "\" form-url=\"" . $formUrl . "\" form-style=\"fab\" form-link-text=\"" . $title . "\" form-button-color=\"#3f51b5\" form-button-icon=\"" . $server . "/pages/formbuilder/images/send-icon.png\"></script>";
        } else if ($type == "link") {
            $result .= "<a href=\"" . $formUrl . "\" target=\"_blank\">" . $title . "</a>";
        }
        $result = "\n<!--START---- RAVESH FORM BUILDER ---- RAVESHCRM.IR ----->\n" . $result . "\n<!--END--- RAVESH FORM BUILDER ---- RAVESHCRM.IR ----->\n";

        return $result;
    }

    */
}
?>