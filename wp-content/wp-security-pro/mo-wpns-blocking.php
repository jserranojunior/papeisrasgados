<?php
/** Copyright (C) 2015  miniOrange

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>
* @package 		miniOrange OAuth
* @license		http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*
**/

class Mo_WPNS_Blocking{
	
	// IP range blocking
	function is_ip_range_blocked($userIp){
		if(empty($userIp))
			return false;
		$range_count = 0;
		if(is_numeric(get_option('mo_wpns_iprange_count')))
			$range_count = intval(get_option('mo_wpns_iprange_count'));
		for($i = 1 ; $i <= $range_count ; $i++){ 
			$blockedrange  = get_option('mo_wpns_iprange_range_'.$i);
			$rangearray = explode("-",$blockedrange);
			if(sizeof($rangearray)==2){
				$lowip = ip2long(trim($rangearray[0]));
				$highip = ip2long(trim($rangearray[1]));
				if(ip2long($userIp)>=$lowip && ip2long($userIp)<=$highip){
					$mo_wpns_config = new Mo_WPNS_Handler();
					$mo_wpns_config->block_ip($userIp, Mo_WPNS_Messages::IP_RANGE_BLOCKING, true);
					return true;
				}
			}
		}
		return false;
	}
	
	function is_browser_blocked(){
		
		//if(get_option('mo_wpns_enable_user_agent_blocking'))
			return false;
		
		$useragent = $_SERVER['HTTP_USER_AGENT'];
		if(empty($useragent))
			return false;
		$useragent = strtolower($useragent);

		if(get_option('mo_wpns_block_chrome') && (strpos($useragent, 'chrome') !== false 
			|| strpos($useragent, 'CriOS') !== false))
			return true;
		else if(get_option('mo_wpns_block_firefox') && strpos($useragent, 'firefox') !== false)
			return true;
		else if(get_option('mo_wpns_block_ie') && strpos($useragent, 'msie') !== false)
			return true;
		else if(get_option('mo_wpns_block_opera') && strpos($useragent, 'opera') !== false)
			return true;
		else if(get_option('mo_wpns_block_safari') && strpos($useragent, 'opera') !== false)
			return true;
		
		return false;
	}
	
} ?>