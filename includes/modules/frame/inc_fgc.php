<?php
  $incfile = DIR_WS_MODULES . "order_total/" . "ot_freegift_chooser.php";
  if (file_exists($incfile)) {
     include_once ($incfile);
     $discount = new ot_freegift_chooser();
     if ($discount->check()) {
        $fgc = $discount->calculate_deductions();
        if ($fgc['total'] > 0) {
           if ($current_page_base == "shopping_cart") {
              echo '<div class="cartDiscount">';
              echo FGC_DEDUCTIONS . ": "; 
              echo '-' . $currencies->format($fgc['total'], true, $order->info['currency'], $order->info['currency_value']);
              echo '</div>';
           } else {
              $content .= '<div class="cartBoxDiscount">'; 
              $content .= FGC_DEDUCTIONS . ": "; 
              $content .= '-' . $currencies->format($fgc['total'], true, $order->info['currency'], $order->info['currency_value']);
              $content .= '</div>'; 
           }
        }
     }
  }
?>
