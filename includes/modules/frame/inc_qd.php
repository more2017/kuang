<?php
  $incfile = DIR_WS_MODULES . "order_total/" . "ot_quantity_discount.php";
  if (file_exists($incfile)) {
     include_once ($incfile);
     $discount = new ot_quantity_discount();
     if ($discount->check()) {
        $qd = $discount->calculate_deductions();
        if ($qd['total'] > 0) {
           if ($current_page_base == "shopping_cart") { 
              echo '<div class="cartDiscount">';
              echo QD_DEDUCTIONS . ": "; 
              echo '-' . $currencies->format($qd['total'], true, $order->info['currency'], $order->info['currency_value']);
              echo '</div>';
           } else {
              $content .= '<div class="cartBoxDiscount">'; 
              $content .= QD_DEDUCTIONS . ": "; 
              $content .= '-' . $currencies->format($qd['total'], true, $order->info['currency'], $order->info['currency_value']);
              $content .= '</div>'; 
           }
        }
     }
  }
?>
