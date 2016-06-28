<?php
 // These functions are for MailChimp API 1.3
 function mailchimp_add($email_address, $email_format) {
    include_once(DIR_WS_CLASSES . "MCAPI.class.php");
    $api = new MCAPI(BOX_MAILCHIMP_NEWSLETTER_API_KEY);
    $merge_vars = array('');
    if ($email_format == 'TEXT') {
       $format = 'text'; 
    } else {
       $format = 'html'; 
    }

    $list_id = BOX_MAILCHIMP_NEWSLETTER_ID; 
    $retval = $api->listSubscribe($list_id, $email_address, $merge_vars, $format);
    if ($api->errorCode){
        $errorMessage = "Unable to load listSubscribe()!\n" . 
           "\tCode=".$api->errorCode."\n" .
           "\tMsg=".$api->errorMessage."\n";
          $file = DIR_FS_SQL_CACHE . '/' . 'MailChimp.log';
          if ($fp = @fopen($file, 'a')) {
            fwrite($fp, $errorMessage);
            fclose($fp);
          }
    }
 }
?>
