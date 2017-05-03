<?php
    $fp = fopen("./log/log","a+");
	fwrite($fp,date('Y-m-d H:i:s')." 开始！\n");
	$fp2 = fopen("./log/return","a+");
	fwrite($fp2,date('Y-M-D H:i:s')." 开始! \n");	
	$url = "http://pt.hit.edu.cn/takelogin.php";
	$data = "username=403519445@qq.com&password=mxx123456789";

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
	$url = "http://pt.hit.edu.cn/take_signin_bonus.php";
	for($i=0;$i<1000;$i++){
		$ch = curl_init($url);	
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_COOKIEFILE,$cookie);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$a = curl_exec($ch);
		if($a == -1){
			$url = "http://pt.hit.edu.cn/take_signin_bonus.php?redate=1";
		}
		echo $a;
		fwrite($fp2,"**********".$i."********** \n".$a." \n \n");
		curl_close($ch);
		if(strstr($a,'成功') != ''){
			break;
		}
		if(i > 100){
			usleep(20000);
		}else{
			usleep(200);
		}
	}
	if ($i == 1000){
		fwrite($fp,date('Y-m-d H:i:s')." Errorr!\n");
		echo "Error!";
	}else{
		fwrite($fp,date('Y-m-d H:i:s')." 请求次数为:".$i." Success!\n");
		echo "Success";
	}
	fclose($fp);
	fclose($fp2);
?>
