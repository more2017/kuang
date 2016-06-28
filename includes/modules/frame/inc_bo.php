<?php
  $incfile = DIR_WS_MODULES . "order_total/" . "ot_bogo_discount.php";
  if (file_exists($incfile)) {
     include_once ($incfile);
     $discount = new ot_bogo_discount();
     if ($discount->check()) {
        $bo = $discount->calculate_deductions();
        if ($bo['total'] > 0) {
           if ($current_page_base == "shopping_cart") {
              echo '<div class="cartDiscount">';
              echo BO_DEDUCTIONS . ": "; 
              echo '-' . $currencies->format($bo['total'], true, $order->info['currency'], $order->info['currency_value']);
              echo '</div>';
           } else {
              $content .= '<div class="cartBoxDiscount">'; 
              $content .= BO_DEDUCTIONS . ": "; 
              $content .= '-' . $currencies->format($bo['total'], true, $order->info['currency'], $order->info['currency_value']);
              $content .= '</div>'; 
           }
        }
     }
  }
?>
