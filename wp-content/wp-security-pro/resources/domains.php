<?php

class Mo_WPNS_Blacklisted_Domains{

	public static function check_if_valid_email($email) {
		$emailarray = explode("@",$email);
		if(sizeof($emailarray)==2){
			return in_array($emailarray[1], Mo_WPNS_Blacklisted_Domains::$domains);
		}else
			return false;
		
	}

}

?>