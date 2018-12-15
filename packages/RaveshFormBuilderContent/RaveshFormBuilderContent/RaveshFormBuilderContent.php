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
    
    
    function onContentPrepare($context, $article, $params, $limitstart)
    {
        $isCRM='false';
        $isFormican='false';
        $doc = JFactory::getDocument();
		$apps = array("RaveshForm", "FormAfzar", "Formican");
        
        $pieces = explode("]", $article->text);
        
        for ($i = 0; $i < count($pieces); $i++) {
            
            for ($appNum = 0; $appNum < count($apps); $appNum++) {
				$app = $apps[$appNum];
                $j = strpos($pieces[$i], "[" . $app);
                $x = explode("[" . $app, $pieces[$i]);
				
                //$doc->addScriptDeclaration("console.log('". $j ."');");
                if ($j >= 0 && count($x)>1) {
					
                    $server = "";
                    $domain = "";
                    $formid = "";
                    $type   = "inline";
                    $title  = "View form";
                    $comment= "";
					
                    $searchText = "[" . $app . $x[1] . "]";
                    
                    $df = explode(" ", $x[1]);
                    for ($propIndex = 0; $propIndex < count($df); $propIndex++) {
                        if (trim($df[$propIndex] != "")) {
                            $propKeyValue = explode("=", $df[$propIndex]);
							if (count($propKeyValue)>1){
								$value = str_replace("\"", "", $propKeyValue[1]);
								if ($propKeyValue[0] == "server") $server = $value;
								if ($propKeyValue[0] == "domain" || $propKeyValue[0] == "secretcode") $domain = $value;
								if ($propKeyValue[0] == "formid") $formid = $value;
								if ($propKeyValue[0] == "type") $type = $value;
								if ($propKeyValue[0] == "title") $title = $value;
							}
                        }
                    }
                    
					if ($isCRM=="true"){
						if (substr($server, -1) != "/") $server = $server . "/";
						$comment="RAVESH FORM BUILDER ---- RAVESHCRM.IR";
					}else{
						if ($isFormican=="true") {
							$server = "http://Formican.com/";
							$comment="FORMICAN FORM BUILDER ---- FORMICAN.COM";
						}else{
							$server = "http://FormAfzar.com/";
							$comment="FORMAFZAR FORM BUILDER ---- FORMAFZAR.COM";
						}
					}
                    
                    $scriptUrl = $server . "pages/formbuilder/ravesh-formbuilder.js";
                    $formUrl   = $server . $domain . "/formView/" . $formid;
					
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
                    $replaceText = "\n<!--START---- $comment ----->\n" . $result . "\n<!--END--- $comment ----->\n";
                    
					$article->text=str_replace($searchText,$replaceText,$article->text);
                }
            }
        }
        
        return false;
    }
}
?>