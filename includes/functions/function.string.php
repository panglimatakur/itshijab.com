<?php defined("mainload") or die("Restricted Access"); ?>
<?php
function cookie_destroy(){
	if (isset($_SERVER['HTTP_COOKIE'])) {
		$cookies = explode(';', $_SERVER['HTTP_COOKIE']);
		foreach($cookies as $cookie) {
			$parts = explode('=', $cookie);
			$name  = trim($parts[0]);
			setcookie($name, '', time()-1000);
			setcookie($name, '', time()-1000, '/');
		}
	}
}
function set_array_cookie($cookie_name,$cookie_array_value){
	setcookie($cookie_name,json_encode($cookie_array_value), time()+3600);
}
function get_array_cookie($cookie_name){
	$cookie 			= $_COOKIE[$cookie_name];
	$cookie 			= stripslashes($cookie);
	$decoded_cookie 	= json_decode($cookie, true);	
	return $decoded_cookie;
}
function generate_password( $length = 8 ) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
    $password = substr( str_shuffle( $chars ), 0, $length );
    return $password;
}
function random_color(){
   $color = "#".dechex(rand(0,10000000));
   return $color;
}
function embedYoutube($idvideo,$attr){
	$result = '<iframe '.$attr.' src="http://www.youtube.com/embed/'.$idvideo.'" allowfullscreen></iframe>';
	return $result;
}

function youtubeThumb($id,$attr){
	$result = '<img src="http://img.youtube.com/vi/'.$id.'/default.jpg"  '.$attr.'/>';
	return $result;
}


function createThumbs($pathToImages,$pathToThumbs,$thumbWidth ) {
	$info = pathinfo($pathToImages);
	if(strtolower($info['extension']) == 'jpg')  { $img = imagecreatefromjpeg("{$pathToImages}");  	}
	if(strtolower($info['extension']) == 'gif')  { $img = imagecreatefromgif("{$pathToImages}");  	}
	if(strtolower($info['extension']) == 'png')  { $img = imagecreatefrompng("{$pathToImages}");  	}

	$width 		= imagesx($img);
	$height 	= imagesy($img);
	$new_width 	= $thumbWidth;
	$new_height = floor($height * ( $thumbWidth / $width ));
	$tmp_img 	= imagecreatetruecolor( $new_width, $new_height );
	imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
	
	if(strtolower($info['extension']) == 'jpg')  { imagejpeg($tmp_img, "{$pathToThumbs}" );			}
	if(strtolower($info['extension']) == 'gif')  { imagegif($tmp_img, "{$pathToThumbs}" );			} 
	if(strtolower($info['extension']) == 'png')  { imagepng($tmp_img, "{$pathToThumbs}" );			} 
}


function permalink($str,$prefix){
	$links = preg_replace('/[^-a-z]+/', $prefix, trim(strtolower($str)));
	return $links;
}
function msg($isi,$type){
	if($type == "error")	{ $class = "alert-danger"; 		}
	if($type == "warning")	{ $class = "alert-warning"; 	}
	if($type == "success")	{ $class = "alert-success"; 	}
	if($type == "info")		{ $class = "alert-info"; 	}
	$msg = "<div class='status alert ".@$class."' style='margin:5px;'>".$isi."</div>";
	return $msg;
}
function redirect_page($page_target) {
	echo "<script language=javascript>self.location.href = '".$page_target."';</script>	";
}

function money($cur,$str){
	$num = $cur."".str_replace(",",".",number_format($str));
	return $num;
}
function cutext($text,$limit){
	$jmlstr = strlen($text);
	if($jmlstr > $limit){
		$result = substr($text,0,$limit)."...";	
	}
	else{
		$result = $text;
	}
	return $result;
}
function generateString($length = 10) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

function sendmail($to,$subject,$msg,$from,$type){
	if($type == 'html'){ 
		$headers = "From: ".$from."\r\n"; 
		$headers .= "MIME-Version: 1.0\r\n"; 
		$boundary = uniqid("HTMLEMAIL"); 
		$headers .= "Content-Type: multipart/alternative;".
					"boundary = ".$boundary."\r\n\r\n"; 
		$headers .= "This is a MIME encoded message.\r\n\r\n"; 
		$headers .= "--".$boundary."\r\n".
					"Content-Type: text/plain; charset=ISO-8859-1\r\n".
					"Content-Transfer-Encoding: base64\r\n\r\n";              
		$headers .= chunk_split(base64_encode(strip_tags($msg))); 
		$headers .= "--".$boundary."\r\n".
					"Content-Type: text/html; charset=ISO-8859-1\r\n".
					"Content-Transfer-Encoding: base64\r\n\r\n";    
		$headers .= chunk_split(base64_encode($msg)); 	
	}
	if($type == 'text'){ 
		$headers = "From: ".$from."\r\nReply-To:".$from;
	}
	mail($to,$subject,'',$headers);
}


function current_val($n,$maxn,$maxsize){
	if($n > 1){
	$scale 	= $maxn/$n;
	$result = round($maxsize/$scale);
	}else{ $result = 1; }
	return $result;
	
}
function getOS($user_agent) { 
    $os_platform    =   $user_agent;
    $os_array       =   array(
                            '/windows nt 6.3/i'     =>  'Windows 8.1',
                            '/windows nt 6.2/i'     =>  'Windows 8',
                            '/windows nt 6.1/i'     =>  'Windows 7',
                            '/windows nt 6.0/i'     =>  'Windows Vista',
                            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                            '/windows nt 5.1/i'     =>  'Windows XP',
                            '/windows xp/i'         =>  'Windows XP',
                            '/windows nt 5.0/i'     =>  'Windows 2000',
                            '/windows me/i'         =>  'Windows ME',
                            '/win98/i'              =>  'Windows 98',
                            '/win95/i'              =>  'Windows 95',
                            '/win16/i'              =>  'Windows 3.11',
                            '/macintosh|mac os x/i' =>  'Mac OS X',
                            '/mac_powerpc/i'        =>  'Mac OS 9',
                            '/linux/i'              =>  'Linux',
                            '/ubuntu/i'             =>  'Ubuntu',
                            '/iphone/i'             =>  'iPhone',
                            '/ipod/i'               =>  'iPod',
                            '/ipad/i'               =>  'iPad',
                            '/android/i'            =>  'Android',
                            '/blackberry/i'         =>  'BlackBerry',
                            '/webos/i'              =>  'Mobile'
                        );

    foreach ($os_array as $regex => $value) { 
        if (preg_match($regex, $user_agent)) {
            $os_platform    =   $value;
        }
    }   
    return $os_platform;
}


?>