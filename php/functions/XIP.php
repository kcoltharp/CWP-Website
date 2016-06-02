<?php

//INTERNAL USE - Magic Number base for constants
$MNbase = 0;

//INTERNAL USE - constants for "HeaderType" array value
define("XIP_HT_None", ++$MNbase, true); //Header value contains no readable information about proxy or client
define("XIP_HT_PName", ++$MNbase, true); //Header value contains proxy name/version
define("XIP_HT_PInfo", ++$MNbase, true); //Header value contains other info about proxy (reserved)
define("XIP_HT_ClientIP", ++$MNbase, true); //Header value contains client IP

class XIP{

	var $IP = array();
	var $Proxy = array();
	var $BL_Safe = false;
	var $Private_IP_Normal = '0.0.0.0/8, 1.0.0.0/8, 2.0.0.0/8, 10.0.0.0/8,
                              127.0.0.0/8, 169.254.0.0/16, 172.16.0.0/12, 192.0.2.0/24,
                              192.168.0.0/16, 198.18.0.0/15, 224.0.0.0/3';
	/*
	  0.0.0.0/8, "This" Network
	  10.0.0.0/8, Private-Use Networks
	  127.0.0.0/8, Loopback
	  169.254.0.0/16, Link Local
	  172.16.0.0/12, Private-Use Networks
	  192.0.2.0/24, Test-Net
	  192.168.0.0/16, Private-Use Networks
	  198.18.0.0/15, Network Interconnect Device Benchmark Testing
	 */
	var $Private_IP_Extended = '0.0.0.0/8, 1.0.0.0/8, 2.0.0.0/8, 5.0.0.0/8,
                                 7.0.0.0/8, 10.0.0.0/8, 23.0.0.0/8, 27.0.0.0/8,
                                 31.0.0.0/8, 36.0.0.0/8, 37.0.0.0/8, 39.0.0.0/8,
                                 42.0.0.0/8, 49.0.0.0/8, 50.0.0.0/8, 77.0.0.0/8,
                                 78.0.0.0/8, 79.0.0.0/8, 92.0.0.0/8, 93.0.0.0/8,
                                 94.0.0.0/8, 95.0.0.0/8, 96.0.0.0/8, 97.0.0.0/8,
                                 98.0.0.0/8, 99.0.0.0/8, 100.0.0.0/8, 101.0.0.0/8,
                                 102.0.0.0/8, 103.0.0.0/8, 104.0.0.0/8, 105.0.0.0/8,
                                 106.0.0.0/8, 107.0.0.0/8, 108.0.0.0/8, 109.0.0.0/8,
                                 110.0.0.0/8, 111.0.0.0/8, 112.0.0.0/8, 113.0.0.0/8,
                                 114.0.0.0/8, 115.0.0.0/8, 116.0.0.0/8, 117.0.0.0/8,
                                 118.0.0.0/8, 119.0.0.0/8, 120.0.0.0/8, 127.0.0.0/8,
                                 169.254.0.0/16, 172.16.0.0/12, 173.0.0.0/8, 174.0.0.0/8,
                                 175.0.0.0/8, 176.0.0.0/8, 177.0.0.0/8, 178.0.0.0/8,
                                 179.0.0.0/8, 180.0.0.0/8, 181.0.0.0/8, 182.0.0.0/8,
                                 183.0.0.0/8, 184.0.0.0/8, 185.0.0.0/8, 186.0.0.0/8,
                                 187.0.0.0/8, 192.0.2.0/24, 192.168.0.0/16, 197.0.0.0/8,
                                 198.18.0.0/15, 223.0.0.0/8, 224.0.0.0/3';
	var $exfile = ''; //Load Extended Private IP Address List from this file (will overwrite existing list)
	var $ex_private = false; //Use Extended List in private IP detection
	var $ex_proxy = false; //Use Extended List in proxy (client IP) detection
	var $Proxy_Evidence = array(
		Array('HTTP_VIA', XIP_HT_PName, true), // example.com:3128 (Squid/2.4.STABLE6)
		Array('HTTP_PROXY_CONNECTION', XIP_HT_None, true), //Keep-Alive
		Array('HTTP_XROXY_CONNECTION', XIP_HT_None, true), //Keep-Alive
		Array('HTTP_X_FORWARDED_FOR', XIP_HT_ClientIP, true), //X.X.X.X, X.X.X.X
		Array('HTTP_X_FORWARDED', XIP_HT_PInfo, true), //?
		Array('HTTP_FORWARDED_FOR', XIP_HT_ClientIP, true), //?
		Array('HTTP_FORWARDED', XIP_HT_PInfo, true), //by http://proxy.example.com:8080 (Netscape-Proxy/3.5)
		Array('HTTP_X_COMING_FROM', XIP_HT_ClientIP, true), //?
		Array('HTTP_COMING_FROM', XIP_HT_ClientIP, true),
		Array('HTTP_CLIENT_IP', XIP_HT_ClientIP, true), //X.X.X.X
		Array('HTTP_PC_REMOTE_ADDR', XIP_HT_ClientIP, true), //X.X.X.X
		Array('HTTP_CLIENTADDRESS', XIP_HT_ClientIP, true),
		Array('HTTP_CLIENT_ADDRESS', XIP_HT_ClientIP, true),
		Array('HTTP_SP_HOST', XIP_HT_ClientIP, true),
		Array('HTTP_SP_CLIENT', XIP_HT_ClientIP, true),
		Array('HTTP_X_ORIGINAL_HOST', XIP_HT_ClientIP, true),
		Array('HTTP_X_ORIGINAL_REMOTE_ADDR', XIP_HT_ClientIP, true),
		Array('HTTP_X_ORIG_CLIENT', XIP_HT_ClientIP, true),
		Array('HTTP_X_CISCO_BBSM_CLIENTIP', XIP_HT_ClientIP, true),
		Array('HTTP_X_AZC_REMOTE_ADDR', XIP_HT_ClientIP, true),
		Array('HTTP_10_0_0_0', XIP_HT_ClientIP, true),
		Array('HTTP_PROXY_AGENT', XIP_HT_PName, true),
		Array('HTTP_X_SINA_PROXYUSER', XIP_HT_ClientIP, true),
		Array('HTTP_XXX_REAL_IP', XIP_HT_ClientIP, true),
		array('HTTP_X_REMOTE_ADDR', XIP_HT_ClientIP, true),
		array('HTTP_RLNCLIENTIPADDR', XIP_HT_ClientIP, true),
		array('HTTP_REMOTE_HOST_WP', XIP_HT_ClientIP, true),
		array('HTTP_X_HTX_AGENT', XIP_HT_PName, true),
		array('HTTP_XONNECTION', XIP_HT_None, true),
		array('HTTP_X_LOCKING', XIP_HT_None, true),
		array('HTTP_PROXY_AUTHORIZATION', XIP_HT_None, true),
		array('HTTP_MAX_FORWARDS', XIP_HT_None, true),
		//array('HTTP_FROM', XIP_HT_ClientIP, true,'value'=>'/(\d{1,3}\.){3}\d{1,3}/'), //proxy is detected if header contains IP
		array('HTTP_X_IWPROXY_NESTING', XIP_HT_None, true),
		array('HTTP_X_TEAMSITE_PREREMAP', XIP_HT_None, true), //http://www.example.com/example...
		array('HTTP_X_SERIAL_NUMBER', XIP_HT_None, true),
		array('HTTP_CACHE_INFO', XIP_HT_None, true),
		array('HTTP_X_BLUECOAT_VIA', XIP_HT_PName, true),
		//search inside REMOTE_HOST
		/*
		  REMOTE_HOST can always be empty whether or not you have a host name,
		  This is because hostname lookups are turned off by default in many web hosting setups
		  look at here for more info and solutions => http://www.php.net/manual/en/function.gethostbyaddr.php
		 */
		//Yes, if remote host contains something like proxy123.example.com
		array('REMOTE_HOST', XIP_HT_None, true, 'value' => '/proxy.*\..*\..*/'),
		//Yes, if remote host contains something like cache123.example.com
		array('REMOTE_HOST', XIP_HT_None, true, 'value' => '/cache.*\..*\..*/'),
		//Guess Unknown headers using Regular expressions
		//array('/^HTTP_X_.*/', XIP_HT_None, true),
		array('/^HTTP_X_.*/', XIP_HT_ClientIP, true),
		array('/^HTTP_PROXY.*/', XIP_HT_None, true),
		array('/^HTTP_XROXY.*/', XIP_HT_None, true),
		array('/^HTTP_XPROXY.*/', XIP_HT_None, true),
		array('/^HTTP_VIA.*/', XIP_HT_None, false),
		array('/^HTTP_XXX.*/', XIP_HT_None, false),
		array('/^HTTP_XCACHE.*/', XIP_HT_None, false)
	);
	//INTERNAL USE - IP pattern
	var $ipp = '';

	/**
	 *   Function to check if IP is a Public IP or not.
	 *
	 *   boolean isPublic(string ip)
	 *   Returns true if IP is a Public IP and false if IP is not a Public IP (and false if IP is not valid)
	 *   IT IS INVERSE OF $XIP->isPrivate() FUNCTION BELOW
	 */
	function isPublic($ip){
		if(!$this->isValid($ip))
			return false;
		return !$this->isPrivate($ip);
	}

	/**
	 *   Function to check if IP is a Private IP (belongs to a Local Network) or not.
	 *
	 *   boolean isPrivate(string ip)
	 *   Returns true if IP is a Private IP and false if IP is not a Private IP (and false if IP is not valid)
	 *   Example: if ($XIP->isPrivate('172.25.66.7')) echo "ip belongs to local netwok"; //will output "ip belongs to local netwok"
	 */
	function isPrivate($ip){
		if(!$this->isValid($ip))
			return false;
		$networks = ($this->ex_private) ? $this->Private_IP_Extended : $this->Private_IP_Normal;
		return $this->CheckNet($networks, $ip);
	}

	/**
	 *   Function to check if IP is Valid. (IPv4)
	 *
	 *   boolean isValid(string ip)
	 *   Returns true if IP is valid and false if IP is not valid
	 *   Does a syntax and range check on IP.
	 *   Validates only dotted decimal IP notation 0.0.0.0-255.255.255.255 (without leading zeros or octal syntax)
	 *   Example: if ($XIP->isValid('127.0.0.1')) echo "ip is valid"; //will output "ip is valid"
	 */
	function isValid($ip){
		return (preg_match('/^' . $this->ipp . '$/', trim($ip)) > 0);
	}

	/**
	 *   Function to check if IP belongs to given Network or not
	 *   This function can be used for IP BLACKLIST, WHITELIST check
	 *
	 *   boolean CheckNet(mixed networks, string ip)
	 *   $networks parameter can be a string, comma separated strings,one string per line or array of strings in this format "IP[/MASK]", which you prefer...
	 *   $ip parameter refers to client IP by default; it is usually omitted on BLACKLIST, WHITELIST check usage; see examples below..
	 *   Example:
	 *            if ($XIP->CheckNet('127.0.0.0/255.255.255.0','127.0.0.5')) echo "IP belongs to given network"; //will output "ip belongs to given network"
	 *
	 *            * IP Range Check examples *:
	 *            //If you want to check if IP is in range of 192.168.2.0 to 192.168.2.255
	 *            if ($XIP->CheckNet('192.168.2.0/255.255.255.0')) echo "YES IN RANGE"; //check the client IP
	 *            if ($XIP->CheckNet('192.168.2.0/255.255.255.0',$ip)) echo "YES IN RANGE"; //check the given IP
	 *            //If you want to check if IP is in range of 192.168.0.0 to 192.168.255.255
	 *            if ($XIP->CheckNet('192.168.2.0/255.255.0.0')) echo "YES IN RANGE"; //check the client IP
	 *            if ($XIP->CheckNet('192.168.2.0/255.255.0.0',$ip)) echo "YES IN RANGE"; //check the given IP
	 *
	 *            * IP BLACKLIST, WHITELIST examples *:
	 *            $blacklist="10.0.5.0, 10.0.5.1, 10.0.5.2, 10.0.4.0/24, 10.0.3.0/255.255.255.0";
	 *            if ($XIP->CheckNet($blacklist)) echo "IP is in BLACKLIST"; //check the client IP
	 */
	function CheckNet($networks, $ip = ''){
		//use client IP as default if $ip parameter omitted (see BL_Safe for more explanations)
		if(empty($ip))
			$ip = ($this->BL_Safe) ? $this->IP['proxy'] : $this->IP['client'];
		if(!$this->isValid($ip))
			return false;
		$ipl = ip2long(trim($ip));
		//if ($ipl===false) $ipl=-1;//ip2long returns FALSE for 255.255.255.255, convert it to its real value -1 (only PHP 5.0.0 < 5.0.3)
		$ips = (is_array($networks)) ? $networks : preg_split('/[\s,]+/', $networks);
		foreach($ips as $value){
			if(preg_match('/^' . $this->ipp . '(\/\d|\/' . $this->ipp . ')?/', $value)){
				$ipa = explode('/', $value);
				if(count($ipa) < 2)
					$ipa[1] = ''; //prevent notice level error (I've added this line for some users reported notice level errors)
				$net = ip2long($ipa[0]);
				//if ($net===false) $net=-1;
				$x = ip2long($ipa[1]);
				//if ($x===false) $x=-1;
				$mask = long2ip($x) == $ipa[1] ? $x : 0xffffffff << (32 - $ipa[1]);
				if(($ipl & $mask) == ($net & $mask))
					return true;
			}
		}
		return false;
	}

	/**
	 *   This function name alias is deprecated and stands for backward compatibility.
	 *   Parameter order changed and $ip became optional in new CheckNet() function explained above.
	 *   Use CheckNet() function instead of this!
	 */
	function NetCheck($ip, $networks){
		return $this->CheckNet($networks, $ip);
	}

/////////////////////////////////////////////////////////////////////
// INTERNAL FUNCTIONS (PRIVATE)
/////////////////////////////////////////////////////////////////////

	/**
	 *   This constructor function will be run automatically on object creation
	 *   Fills all useful information to $XIP->IP[] and $XIP->Proxy[] arrays for user
	 *   No need to call any functions later for IP detection or proxy detection (see example files)
	 *   However you can call some IP fuctions if you need
	 */
	function XIP(){

		//INTERNAL USE - Some temporary variables used internally, do not touch...
		$ips = '';
		$ipa = array($_SERVER['REMOTE_ADDR']);

		$this->Proxy['detected'] = false;
		$this->Proxy['suspicious'] = false;
		$this->Proxy['name'] = NULL;
		$this->Proxy['info'] = array();
		$this->Proxy['headers'] = array();

		//INTERNAL USE - IP octet pattern
		$ipo = '(25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)';
		//INTERNAL USE - IP pattern
		$this->ipp = "$ipo\\.$ipo\\.$ipo\\.$ipo";

		//If filename specified, Load Extended Private IP Address List from this file
		if(!empty($this->exfile)){
			$tmp = implode('', file($this->exfile));
			if((!$tmp === false) && (preg_match('/' . $this->ipp . '/', $tmp)))
				$this->Private_IP_Extended = $tmp;
		}

		/**
		 *   EVALUATE $Proxy_Evidence array on HEADERS !!!
		 */
		foreach($this->Proxy_Evidence as $value){
			$tmp = $this->FindHeaders($value[0]);
			foreach($tmp as $hkey => $hvalue){
				//make decision on proxy certainty data
				$pkey = ($value[2] === true) ? 'detected' : 'suspicious';
				if(array_key_exists('value', $value)){
					if(preg_match($value['value'], $hvalue))
						$this->Proxy[$pkey] = true;
				}else{
					$this->Proxy[$pkey] = true;
				}
				//collect data about client IP, proxy name, other info
				if($value[1] == XIP_HT_PName && empty($this->Proxy['name']))
					$this->Proxy['name'] = $hvalue;
				if($value[1] == XIP_HT_ClientIP)
					$ips.=$hvalue . ','; //ips will be parsed later; also headers can contain multiple IP addresses
				if(($value[1] == XIP_HT_PInfo) || ($value[1] == XIP_HT_PName))
					$this->Proxy['info'][$hkey] = $hvalue;
				$this->Proxy['headers'][$hkey] = $hvalue;
			}
		}
		//both 'detected' and 'suspicious' cannot be true
		if($this->Proxy['detected'])
			$this->Proxy['suspicious'] = false;

		//Fill $XIP->IP['proxy'] with REMOTE_ADDR always
		$this->IP['proxy'] = $_SERVER['REMOTE_ADDR'];
		$this->IP['client'] = ''; //multiple call safe (with different options if any)
		//make decision on client IP
		if(preg_match_all('/' . $this->ipp . '/', $ips, $match))
			foreach($match[0] as $value){
				if(!in_array($value, $ipa))
					$ipa[] = $value;
				//Set the first public IP found as client IP
				//if ($this->isPublic($value) && empty($this->IP['client'])) $this->IP['client']=$value;
				$network = ($this->ex_proxy) ? $this->Private_IP_Extended : $this->Private_IP_Normal;
				if(!$this->CheckNet($network, $value) && empty($this->IP['client']))
					$this->IP['client'] = $value;
			}
		//Fill $XIP->IP['all'] with REMOTE_ADDR and all IP addresses comma separated
		$this->IP['all'] = implode(",", $ipa);
		//Fill $XIP->IP['client'] with REMOTE_ADDR if client IP or proxy not detected
		if(empty($this->IP['client']))
			$this->IP['client'] = $this->IP['proxy'];
		$this->Proxy['anonymous'] = ($this->IP['client'] == $this->IP['proxy']) ? true : false;
	}

	/**
	 *   INTERNAL USE - Regular Expression compatible Find Headers function
	 *   To Query existence of a request header and returns found headers
	 */
	function FindHeaders($name){
		$result = array();
		//if ($name[0]<>'/') $name='/^'.$name.'$/';//If regex not found convert it to an "exact phrase" regex as default
		//Return header directly if not written as regular expression (separated for speed)
		if($name[0] <> '/'){
			if(array_key_exists($name, $_SERVER))
				$result[$name] = $_SERVER[$name];
		}else{
			//Regular expression headers search
			foreach($_SERVER as $key => $value){
				if(preg_match($name, $key, $match))
					$result[$key] = $value;
			}
		}
		return $result;
	}

}

//class
?>