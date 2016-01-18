<?php
	// Function to login:
	// the cookie.txt keeps you logged in between functions.
	
	function htsLogin($username, $password) {
		$url = "https://www.hackthissite.org/user/login/";
		$cookiefile = "cookie.txt";
		$referer = "https://www.hackthissite.org";
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0');
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "username=" . $username . "&password=" . $password);
		
		curl_setopt($ch, CURLOPT_AUTOREFERER, true);
		curl_setopt($ch, CURLOPT_REFERER, $referer);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // For 301 pages (moved)
		
		curl_setopt($ch, CURLOPT_COOKIESESSION, true); // We need a cookie to stay loggedin.
		curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);  // Cookiejar on creation, cookiefile on use.
		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // We need to get the data back.
		curl_exec($ch);
				
		
		if(curl_errno($ch)) {
			return false;
		} else {
			return true;			
		}
		curl_close ($ch);
	}
	
	
	// Function to get a pages html (programming missions for example)
	function htsGetHTML($url) {
		$cookiefile = "cookie.txt";
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0');
		
		curl_setopt($ch, CURLOPT_AUTOREFERER, true);
		curl_setopt($ch, CURLOPT_REFERER, $url);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		
		curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile); // Cookiejar on creation, cookiefile on use
		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);	// We need tot get the data back.
		
		$rawdata = curl_exec($ch);

		if(curl_errno($ch)) {
			return false;
		} else {
			return $rawdata;			
		}
		curl_close ($ch);
	}
	
	
	// Function to download a file (needed in one of the programming missions)
	function htsGetFile($url, $filename) {
		$cookiefile = "cookie.txt";
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0');
	
	
		curl_setopt($ch, CURLOPT_AUTOREFERER, true);
		curl_setopt($ch, CURLOPT_REFERER, $url);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		
		curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile); // Cookiejar on creation, cookiefile on use
		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);	// We need tot get the data back.
		curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);

	    $rawdata = curl_exec($ch);
	    
	    if(file_exists($filename)){
	        unlink($filename);
	    }
	    $fp = fopen($filename,'wb');
	    fwrite($fp, $rawdata);
	    fclose($fp);
		
		
		if(curl_errno($ch)) {
			return false;
		} else {
			return $rawdata;			
		}
		curl_close ($ch);		
	}
	
	// Function to post the solultion
	// the second part 'submitbutton=submit' is needed in some of the cases.
	function htsPostSolution($url, $solution) {
		$cookiefile = "cookie.txt";
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0');
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "solution=" . $solution . "&submitbutton=submit");
	
	
		curl_setopt($ch, CURLOPT_AUTOREFERER, true);
		curl_setopt($ch, CURLOPT_REFERER, $url);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		
		curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);	
		
		curl_exec($ch);
		
		curl_close ($ch);		
	}	