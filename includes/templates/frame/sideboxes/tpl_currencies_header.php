<?php

/**

 * Top Box Template

 *

 * @package templateSystem

 * @copyright Copyright 2007 iChoze Internet Solutions http://ichoze.com

 * @copyright Portions Copyright 2003-2006 Zen Cart Development Team

 * @copyright Portions Copyright 2003 osCommerce

 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0

 */
reset($currencies->currencies);
      $currencies_array = array();
      while (list($key, $value) = each($currencies->currencies)) {
        $currencies_array[] = array('id' => $key, 'text' => $value['title']);
      }

      $hidden_get_variables = '';
      reset($_GET);
      while (list($key, $value) = each($_GET)) {
        if ( ($key != 'currency') && ($key != zen_session_name()) && ($key != 'x') && ($key != 'y') ) {
          $hidden_get_variables .= zen_draw_hidden_field($key, $value);
        }
      }
$content .=!empty($_GET[cPath])?'&cPath='.$_GET[cPath].'':'';
$content .=!empty($_GET[products_id])?'&products_id='.$_GET[products_id].'':'';

$content = "";
 $content .= zen_draw_form('currencies_form', zen_href_link(basename(ereg_replace('.php','', $PHP_SELF)), '', $request_type, false), 'get','class="currecies"');
$content .='<div class="topcurrencies">';
$content .='<ul class="lcurrence">';
$content .='<li id="dollar">';
$content .='<a href="#currence" rel="nofollow">';
$content .='<b>Currencies: </b>';
$content .='<u>';
$content .='<em>'.$_SESSION['currency'].'</em>';
$content .='</u>';
//$content .='<img align="absmiddle" hspace="3" border="0" src="images/flag/'.$_SESSION['currency'].'.gif">';
$content .='</a>';
$content .='<ul class="pcurrence">';
foreach($currencies_array as $v){ 
if($_SESSION['currency']!=$v['id']){
$content .='<li>';
//$content .='<img border="0" src="images/flag/'.$v["id"].'.gif">';
$content .='<a href="javascript:submit_value(\''.$v["id"].'\')" rel="nofollow">';
$content.=$v["text"].'</a>';
$content .='</li>';
  }
 } 
$content .='</ul>';
$content .= '</li>';
$content .='</ul>';
$content .='</div>';
$content.='<input type="hidden" name="currency" value="'.$_SESSION['currency'].'" id="currency_sub"/>';
$content.=$hidden_get_variables . zen_hide_session_id();
$content .= '</form>';
$content .= '<script type="text/javascript">';
$content .='function submit_value($val){';
$content .='v=$val;';
$content .='$("#currency_sub").val(v);';
$content .='$(".currecies").submit();';
$content .='}';
$content .= '</script>';

?>
<?php echo $content;?>
