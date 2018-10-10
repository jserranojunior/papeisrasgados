
<div class='apss-popup-overlay' id="apss-popup-overlay-email" style="display:none"></div>
<div class="apss_email_share_popup" style="display:none;">
<div class='apss_email_share_popup_close'>X</div>
<?php //$this->print_array($this->apss_settings);
$email_sub 	=		$this->apss_settings['apss_email_subject'];
$email_body =	$this->apss_settings['apss_email_body'];


$email_sub = preg_replace( array( '#%%title%%#', '#%%siteurl%%#', '#%%permalink%%#', '#%%url%%#' ), array( get_the_title(), get_site_url(), get_permalink(), $url ), $email_sub );
$email_body = preg_replace( array( '#%%title%%#', '#%%siteurl%%#', '#%%permalink%%#', '#%%url%%#' ), array( get_the_title(), get_site_url(), get_permalink(), $url ), $email_body );

$share_text = $this->apss_settings['popup_options']['share_text'];
?>
	            <div class="apss_popup_top">
	                <div class="title"><?php echo $share_text; ?> </div>
	                <div class="apss_email_share_popup_close_bttn"></div>
	                <div class="clear"></div>
	            </div>
	            <div class="apss_email_popup_content">
	               <div class="apss_email_popup_form">
	                <div class="apss_email_popup_name apss-email-block">
	                  <input type="text" id="apss_email_popup_name" placeholder="Your Name" onkeyup="removeMe('apss_email_popup_name_error');">
	                  <div class='error apss_email_popup_name_error'></div>
					</div> 
					<div class="apss_email_popup_from apss-email-block"> 
			          <input type="text" id="apss_email_popup_from" placeholder="Your email" onkeyup="removeMe('apss_email_popup_from_error');">
			          <div class='error apss_email_popup_from_error'></div>
					</div>
					<div class="apss_email_popup_sendto apss-email-block">
	                  <input type="text" id="apss_email_popup_receiver" placeholder="Friend's email address" onkeyup="removeMe('apss_email_popup_sendto_error');">
	                  <div class='error apss_email_popup_sendto_error'></div>
					</div>

					<div class='apss-sub-wrap apss-email-block'>
						<div class="apss_email_popup_label">
		                   Subject:
		                 </div>

						 <div class="apss_email_popup_subject">
							<input type="text" id="apss_email_popup_subject" value="<?php echo $email_sub; ?>">
		                </div>
	                </div>
	                <div class='apss-message-wrap apss-email-block'>
						<div class="apss_email_popup_label">
							Message:
						</div>	
		                <div class="apss_email_popup_message">
	                            <textarea id="apss_email_popup_message"><?php echo $email_body; ?></textarea>
		                </div>
	                </div>
	               </div>
	                <button class="apss-the-button" id="apss_email_popup_send_email">Send</button>
	                <span class="apss_email_popup_loading" style="display:none;"><img src='<?php echo APSS_IMAGE_DIR.'/ajax-loader.gif'; ?>' /></span>
					<div class="clear"></div>
	                <div class='apss_email_popup_result'> </div>
	            </div>
</div>
