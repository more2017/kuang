<?php
  // MailChimp sidebox - by That Software Guy
  $content = '';
  $content .= '<div id="' . str_replace('_', '-', $box_id . 'Content') . '" class="sideBoxContent">';
  $content .= '';
  $content .= BOX_MAILCHIMP_PITCH;
  $content .= '<br />';
  $content .= '<br />';

  $content .= '<form action="' . BOX_MAILCHIMP_NEWSLETTER_URL . '?' . 
				'u='. BOX_MAILCHIMP_NEWSLETTER_U . '&amp;' . 
                'id=' . BOX_MAILCHIMP_NEWSLETTER_ID . '" '. 
                'method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form">';
  $content .= ENTRY_EMAIL_ADDRESS; 
  $content .= '<input type="text" name="EMAIL" value="" /><br />';
  $content .= '<input type="radio" name="EMAILTYPE" value="html" checked="checked" />' . ENTRY_EMAIL_HTML_DISPLAY . '&nbsp; &nbsp;<input type="radio" name="EMAILTYPE" value="text" />' . ENTRY_EMAIL_TEXT_DISPLAY;
  $content .= '<br />';
  $content .= '<div style="margin-top: 5px;">';
  $content .= '<input type="submit" name="submit" value="'.BOX_MAILCHIMP_SUBSCRIBE . '" />'; 
  // $content .= '<input type="hidden" name="id" value="' . BOX_MAILCHIMP_NEWSLETTER_ID . '">';
  // $content .= '<input type="hidden" name="u" value="' . BOX_MAILCHIMP_NEWSLETTER_U . '">';
  $content .= '</div>';
  $content .= '</form>';

  $content .= '</div>';
?>
