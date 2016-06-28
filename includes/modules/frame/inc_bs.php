<?php
  $incfile = DIR_WS_MODULES . "order_total/" . "ot_bigspender_discount.php";
  if (file_exists($incfile)) {
     include_once ($incfile);
     $discount = new ot_bigspender_discount();
     if ($discount->check()) {
        $bs = $discount->calculate_deductions();
        if ($bs['total'] > 0) {
           if ($current_page_base == "shopping_cart") {
              echo '<div class="cartDiscount">';
              echo BS_DEDUCTIONS . ": "; 
              echo '-' . $currencies->format($bs['total'], true, $order->info['currency'], $order->info['currency_value']);
              echo '</div>';
           } else {
              $content .= '<div class="cartBoxDiscount">'; 
              $content .= BS_DEDUCTIONS . ": "; 
              $content .= '-' . $currencies->format($bs['total'], true, $order->info['currency'], $order->info['currency_value']);
              $content .= '</div>'; 
           }
        }
     }
  }
?>
