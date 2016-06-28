<?php
  $incfile = DIR_WS_MODULES . "order_total/" . "ot_table_discounts.php";
  if (file_exists($incfile)) {
     include_once ($incfile);
     $discount = new ot_table_discounts();
     if ($discount->check()) {
        $td = $discount->calculate_deductions();
        if ($td['total'] > 0) {
           if ($current_page_base == "shopping_cart") { 
              echo '<div class="cartDiscount">';
              echo TD_DEDUCTIONS . ": "; 
              echo '-' . $currencies->format($td['total'], true, $order->info['currency'], $order->info['currency_value']);
              echo '</div>';
           } else {
              $content .= '<div class="cartBoxDiscount">'; 
              $content .= TD_DEDUCTIONS . ": "; 
              $content .= '-' . $currencies->format($td['total'], true, $order->info['currency'], $order->info['currency_value']);
              $content .= '</div>'; 
           }
        }
     }
  }
?>
