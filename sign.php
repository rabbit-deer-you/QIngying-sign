<?php
	$url = "http://pt.hit.edu.cn/takelogin.php";
	$data = "username=&password=";

	$ch = curl_init($url);
	$cookie =tempnam("./cookie/","cookie");
	
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.61 Safari/537.36");
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_exec($ch);
	curl_close($ch);
	
	for($i=0;$i<1000;$i++){
		$url = "http://pt.hit.edu.cn/take_signin_bonus.php";
		$ch = curl_init($url);	
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_COOKIEFILE,$cookie);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$a = curl_exec($ch);
		echo $a;
		curl_close($ch);
		if(strstr($a,'成功') != ''){
			break;
		}
		usleep(20000);
	}
	$fp = fopen("./log/log","a+");
	if ($i == 100){
		fwrite($fp,date('Y-m-d H:i:s')." Errorr!\n");
		echo "Error!";
	}else{
		fwrite($fp,date('Y-m-d H:i:s')." 请求次数为:".$i." Success!\n");
		echo "Success";
	}
	fclose($fp);
?>
