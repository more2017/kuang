<?php
  $incfile = DIR_WS_MODULES . "order_total/" .  "ot_group_pricing.php";
  if (file_exists($incfile)) {
     if ((int)$_SESSION['customer_id'] != '') {
        include_once ($incfile);
        $discount = new ot_group_pricing();
        if ($discount->check()) {
           $ot = $discount->get_order_total();
           $gp = $discount->calculate_deductions($ot['total']);
           if ($gp['total'] > 0) {
              if ($current_page_base == "shopping_cart") {
                 echo '<div class="cartDiscount">';
                 echo GP_DEDUCTIONS . ": "; 
                 echo '-' . $currencies->format($gp['total'], true, $order->info['currency'], $order->info['currency_value']);
                 echo '</div>';
              } else {
                 $content .= '<div class="cartBoxDiscount">'; 
                 $content .= GP_DEDUCTIONS . ": "; 
                 $content .= '-' . $currencies->format($gp['total'], true, $order->info['currency'], $order->info['currency_value']);
                 $content .= '</div>'; 
              }
           }
        }
     }
  }
?>
