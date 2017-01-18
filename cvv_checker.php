<?php
set_time_limit(0);
//////////////////////////////////////////////////// WELCOME TO CVV2Finder CVV Checker API v1.0 //////////////////////////////////
function checkcvv($ccnum,$ccm,$ccy,$cvv){
	$user 	= "YourUsername";									// Your Username
	$pwd	= "YourPassword";									// Your Password
	$url	= "http://cvv2finder.com/API/cvvchecker.php";
	$data	= "user=".$user."&pwd=".$pwd."&cc=".$ccnum."&ccm=".$ccm."&ccy=".$ccy."&cvv=".$cvv;
    $send	= _curl($url,$data);
	if($send == -200){
		return -200;
	}
	elseif($send == "Live")
	    {
			return 1;
	    }
	    
	    elseif($send == "Die")
	    {
			return 2;
	    }
	    elseif($send == "Error")
	    {
			return 3;
	    }
	    elseif($send == "card_error")
	    {
			return 5;
	    }
	      elseif($send == "user_error")
	    {
			return 6;
	    }
	       elseif($send == "balance")
	    {
			return 7;
	    }
	    else
	    {
			return 4;
	    }
	    

	   
	    // How to use this API?
	    // 1- Include this file in PHP file
	    // 2- make a variable to get the result of check 
	    // example : $result = checkcvv("546661666666","05","19","666"); echo $result;
	    // then you must get some of these numbers and it's mean : 
	    //1 = LIVE
	    //2 = DEAD
	    //3 = API ERROR
	    //4 = UNKNOWN
	    //5 = Card Information error, Check card number , card month , card year or card cvv2
	    //6 = username or password not correct , or API not Active For your account
	    //7 =  insufficient funds


	}


function _curl($url,$post="") {  
	$ch = curl_init();
	if($post) {
		curl_setopt($ch, CURLOPT_POST ,1);
		curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
	}
	curl_setopt($ch, CURLOPT_URL, $url); 
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/6.0 (Windows; U; Windows NT 5.1; en-US; rv:1.7.7) Gecko/20050414 Firefox/1.0.3"); 
	if(stristr($url,"https")){
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1);
	}
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); 
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 6); 
	$result=curl_exec ($ch); 
	$info = curl_getinfo($ch);
	curl_close ($ch); 
	if($info['http_code'] != "200") return -200;
	else return $result; 
}

?>