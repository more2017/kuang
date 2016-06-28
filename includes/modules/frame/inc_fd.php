<?php
  $incfile = DIR_WS_MODULES . "order_total/" . "ot_frequency_discount.php";
  if (file_exists($incfile)) {
     include_once ($incfile);
     $discount = new ot_frequency_discount();
     if ($discount->check()) {
        $fd = $discount->calculate_deductions();
        if ($fd['total'] > 0) {
           if ($current_page_base == "shopping_cart") { 
              echo '<div class="cartDiscount">';
              echo FD_DEDUCTIONS . ": "; 
              echo '-' . $currencies->format($fd['total'], true, $order->info['currency'], $order->info['currency_value']);
              echo '</div>';
           } else {
              $content .= '<div class="cartBoxDiscount">'; 
              $content .= FD_DEDUCTIONS . ": "; 
              $content .= '-' . $currencies->format($fd['total'], true, $order->info['currency'], $order->info['currency_value']);
              $content .= '</div>'; 
           }
        }
     }
  }
?>
