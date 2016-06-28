<?php
  $incfile = DIR_WS_MODULES . "order_total/" . "ot_better_together.php";
  if (file_exists($incfile)) {
     include_once ($incfile);
     $discount = new ot_better_together();
     if ($discount->check()) {
        $bt = $discount->calculate_deductions();
        if ($bt['total'] > 0) {
           if ($current_page_base == "shopping_cart") {
              echo '<div class="cartDiscount">';
              echo BT_DEDUCTIONS . ": "; 
              echo '-' . $currencies->format($bt['total'], true, $order->info['currency'], $order->info['currency_value']);
              echo '</div>';
           } else {
              $content .= '<div class="cartBoxDiscount">'; 
              $content .= BT_DEDUCTIONS . ": "; 
              $content .= '-' . $currencies->format($bt['total'], true, $order->info['currency'], $order->info['currency_value']);
              $content .= '</div>'; 
           }
        }
     }
  }
?>
