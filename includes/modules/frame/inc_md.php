<?php
  $incfile = DIR_WS_MODULES . "order_total/" . "ot_manufacturer_discount.php";
  if (file_exists($incfile)) {
     include_once ($incfile);
     $discount = new ot_manufacturer_discount();
     if ($discount->check()) {
        $md = $discount->calculate_deductions();
        if ($md['total'] > 0) {
           if ($current_page_base == "shopping_cart") { 
              echo '<div class="cartDiscount">';
              echo MD_DEDUCTIONS . ": "; 
              echo '-' . $currencies->format($md['total'], true, $order->info['currency'], $order->info['currency_value']);
              echo '</div>';
           } else {
              $content .= '<div class="cartBoxDiscount">'; 
              $content .= MD_DEDUCTIONS . ": "; 
              $content .= '-' . $currencies->format($md['total'], true, $order->info['currency'], $order->info['currency_value']);
              $content .= '</div>'; 
           }
        }
     }
  }
?>
