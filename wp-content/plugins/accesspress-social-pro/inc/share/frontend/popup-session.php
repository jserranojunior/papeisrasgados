<?php 
			if(!empty($_POST) && wp_verify_nonce( $_POST['_wpnonce'], 'apss-ajax-nonce')){
    			 $popup_url_array = isset($_SESSION['apss_popup_urls'])?$_SESSION['apss_popup_urls']:array();
                 $current_page_url = $_POST['current_page_url'];
    			if(!in_array($current_page_url,$popup_url_array))
                {
                    $popup_url_array[] = $current_page_url;
                    $_SESSION['apss_popup_urls'] = $popup_url_array;
                }
                die('success');	
			}
            else
            {
                die('No script kiddies please!');
            }