<?php
/**
 * Side Box Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_shopping_cart.php 7192 2007-10-06 13:30:46Z drbyte $
 */
  $content ="";

  $content .= '<div id="' . str_replace('_', '-', $box_id . 'Content') . '" class="sideBoxContent">';
  if ($_SESSION['cart']->count_contents() > 0) {
  $content .= '<div id="cartBoxListWrapper">' . "\n" . '<ul>' . "\n";
    $products = $_SESSION['cart']->get_products();
    for ($i=0, $n=sizeof($products); $i<$n; $i++) {
      $content .= '<li>';

      if (isset($_SESSION['new_products_id_in_cart']) && ($_SESSION['new_products_id_in_cart'] == $products[$i]['id'])) {
        $content .= '<span class="cartNewItem">';
      } else {
        $content .= '<span class="cartOldItem">';
      }

      $content .= $products[$i]['quantity'] . BOX_SHOPPING_CART_DIVIDER . '</span><a href="' . zen_href_link(zen_get_info_page($products[$i]['id']), 'products_id=' . $products[$i]['id']) . '">';

      if (isset($_SESSION['new_products_id_in_cart']) && ($_SESSION['new_products_id_in_cart'] == $products[$i]['id'])) {
        $content .= '<span class="cartNewItem">';
      } else {
        $content .= '<span class="cartOldItem">';
      }

      $content .= $products[$i]['name'] . '</span></a></li>' . "\n";

      if (isset($_SESSION['new_products_id_in_cart']) && ($_SESSION['new_products_id_in_cart'] == $products[$i]['id'])) {
        $_SESSION['new_products_id_in_cart'] = '';
      }
    }

    $content .= '</ul>' . "\n" . '</div>';

    $content .= '<hr />';
    $content .= '<div class="cartBoxTotal">' . $currencies->format($_SESSION['cart']->show_total()) . '</div>';

    // <!-- bof Discount Preview logic -->
   
     if (($current_page_base != "shopping_cart")  &&
         ($current_page_base != "account_history_info"))
     { 
        require_once(DIR_WS_CLASSES . 'order.php');
        $order = new order();

/*   
        // build tax groups for UK VAT people who have embedded taxes
        if ($order->info['tax'] == 0) {
          $order->info['tax_groups'] = array();
          if (isset($_SESSION['customer_zone_id'])) {
             $zone = $_SESSION['customer_zone_id']; 
          } else {
             $zone = -1; 
          }
          $order->info['tax_groups'] = zen_get_multiple_tax_rates(1,-1,$zone); 
        }
*/

        // Reorder or delete as appropriate for your shop.
        // group pricing, better together, quantity discounts, 
        // and combination discounts.
        include_once(DIR_WS_MODULES . $template_dir . '/inc_gp.php'); // Group Discount
        include_once(DIR_WS_MODULES . $template_dir . '/inc_bt.php'); // Better Together
        include_once(DIR_WS_MODULES . $template_dir . '/inc_qd.php'); // Quantity Discount
        include_once(DIR_WS_MODULES . $template_dir . '/inc_td.php'); // Table Discounts
        include_once(DIR_WS_MODULES . $template_dir . '/inc_md.php'); // Manufacturer Discount
        include_once(DIR_WS_MODULES . $template_dir . '/inc_cd.php'); // Combination Discounts
        include_once(DIR_WS_MODULES . $template_dir . '/inc_bs.php'); // Big Spender Discounts
        include_once(DIR_WS_MODULES . $template_dir . '/inc_bo.php'); // BOGO Discounts
        include_once(DIR_WS_MODULES . $template_dir . '/inc_bc.php'); // Big Chooser Discounts
        include_once(DIR_WS_MODULES . $template_dir . '/inc_fgc.php'); // Free Gift Chooser Discounts
        include_once(DIR_WS_MODULES . $template_dir . '/inc_cased.php'); // Case Discounts
        include_once(DIR_WS_MODULES . $template_dir . '/inc_fd.php'); // Frequency Discounts

         $newsub = $order->info['subtotal'];
         // UK VAT use this instead 
         // $newsub = $_SESSION['cart']->show_total();
         $shownewsub = 0; 
         if (isset($gp['total']) && ($gp['total'] > 0)) {
            $shownewsub = 1; 
            $newsub -= $gp['total']; 
         }
         if (isset($bt['total']) && ($bt['total'] > 0)) {
            $shownewsub = 1; 
            $newsub -= $bt['total']; 
         }
         if (isset($qd['total']) && ($qd['total'] > 0)) {
            $shownewsub = 1; 
            $newsub -= $qd['total']; 
         }
         if (isset($td['total']) && ($td['total'] > 0)) {
            $shownewsub = 1; 
            $newsub -= $td['total']; 
         }
         if (isset($md['total']) && ($md['total'] > 0)) {
            $shownewsub = 1; 
            $newsub -= $md['total']; 
         }
         if (isset($cd['total'])&& ($cd['total'] > 0)) {
            $shownewsub = 1; 
            $newsub -= $cd['total']; 
         }
         if (isset($bc['total']) && $bc['total'] > 0) {
            $shownewsub = 1; 
            $newsub -= $bc['total']; 
         }
         if (isset($bs['total']) && $bs['total'] > 0) {
            $shownewsub = 1; 
            $newsub -= $bs['total']; 
         }
         if (isset($bo['total']) && $bo['total'] > 0) {
            $shownewsub = 1; 
            $newsub -= $bo['total']; 
         }
         if (isset($fgc['total']) && $fgc['total'] > 0) {
            $shownewsub = 1; 
            $newsub -= $fgc['total']; 
         }
         if (isset($cased['total']) && $cased['total'] > 0) {
            $shownewsub = 1; 
            $newsub -= $cased['total']; 
         }
         if (isset($fd['total']) && $fd['total'] > 0) {
            $shownewsub = 1; 
            $newsub -= $fd['total']; 
         }
         if ($shownewsub == 1) {
            $content .= '<hr />';
            $content .= '<div class="cartBoxTotal">';
            $content .= SUBTOTAL_POSTDISCOUNT . ": "; 
            $content .= $currencies->format($newsub, true, $order->info['currency'], $order->info['currency_value']);
            $content .= '</div>';
            $content .= '<br />'; 
         } 
     }

     // <!-- eof Discount Preview logic -->
  } else {
    $content .= '<div id="cartBoxEmpty">' . BOX_SHOPPING_CART_EMPTY . '</div>';
  }


  if (isset($_SESSION['customer_id'])) {
    $gv_query = "select amount
                 from " . TABLE_COUPON_GV_CUSTOMER . "
                 where customer_id = '" . $_SESSION['customer_id'] . "'";
   $gv_result = $db->Execute($gv_query);

    if ($gv_result->RecordCount() && $gv_result->fields['amount'] > 0 ) {
      $content .= '<div id="cartBoxGVButton"><a href="' . zen_href_link(FILENAME_GV_SEND, '', 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_SEND_A_GIFT_CERT , BUTTON_SEND_A_GIFT_CERT_ALT) . '</a></div>';
      $content .= '<div id="cartBoxVoucherBalance">' . VOUCHER_BALANCE . $currencies->format($gv_result->fields['amount']) . '</div>';
    }
  }
  $content .= '</div>';
?>
