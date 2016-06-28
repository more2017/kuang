<?php
  $incfile = DIR_WS_MODULES . "order_total/" . "ot_big_chooser.php";
  if (file_exists($incfile)) {
     include_once ($incfile);
     $discount = new ot_big_chooser();
     if ($discount->check()) {
        $bc = $discount->calculate_deductions();
        if ($bc['total'] > 0) {
           if ($current_page_base == "shopping_cart") {
              echo '<div class="cartDiscount">';
              echo BC_DEDUCTIONS . ": "; 
              echo '-' . $currencies->format($bc['total'], true, $order->info['currency'], $order->info['currency_value']);
              echo '</div>';
           } else {
              $content .= '<div class="cartBoxDiscount">'; 
              $content .= BC_DEDUCTIONS . ": "; 
              $content .= '-' . $currencies->format($bc['total'], true, $order->info['currency'], $order->info['currency_value']);
              $content .= '</div>'; 
           }
        }
     }
  }
?>
