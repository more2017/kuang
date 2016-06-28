<?php
  $incfile = DIR_WS_MODULES . "order_total/" . "ot_case_discounts.php";
  if (file_exists($incfile)) {
     include_once ($incfile);
     $discount = new ot_case_discounts();
     if ($discount->check()) {
        $cased = $discount->calculate_deductions();
        if ($cased['total'] > 0) {
           if ($current_page_base == "shopping_cart") {
              echo '<div class="cartDiscount">';
              echo CASED_DEDUCTIONS . ": "; 
              echo '-' . $currencies->format($cased['total'], true, $order->info['currency'], $order->info['currency_value']);
              echo '</div>';
           } else {
              $content .= '<div class="cartBoxDiscount">'; 
              $content .= CASED_DEDUCTIONS . ": "; 
              $content .= '-' . $currencies->format($cased['total'], true, $order->info['currency'], $order->info['currency_value']);
              $content .= '</div>'; 
           }
        }
     }
  }
?>
