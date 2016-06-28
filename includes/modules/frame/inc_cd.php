<?php
  $incfile = DIR_WS_MODULES . "order_total/" . "ot_combination_discounts.php";
  if (file_exists($incfile)) {
     include_once ($incfile);
     $discount = new ot_combination_discounts();
     if ($discount->check()) {
        $cd = $discount->calculate_deductions();
        if ($cd['total'] > 0) {
           if ($current_page_base == "shopping_cart") {
              echo '<div class="cartDiscount">';
              echo CD_DEDUCTIONS . ": "; 
              echo '-' . $currencies->format($cd['total'], true, $order->info['currency'], $order->info['currency_value']);
              echo '</div>';
           } else {
              $content .= '<div class="cartBoxDiscount">'; 
              $content .= CD_DEDUCTIONS . ": "; 
              $content .= '-' . $currencies->format($cd['total'], true, $order->info['currency'], $order->info['currency_value']);
              $content .= '</div>'; 
           }
        }
     }
  }
?>
