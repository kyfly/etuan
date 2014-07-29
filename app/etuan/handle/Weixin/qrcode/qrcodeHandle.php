<?php
class QrcodeHandle
{
	public static function getUrl($appid,$appsecret,$action= "QR_LIMIT_SCENE"){
        $token = WS::getToken($appid,$appsecret);
        $url = "https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=$token";
        $arr = [ "expire_seconds"=> 1800 ,"action_name" => $action ,"action_info" => ["scene" => [ "scene_id"=> 123]]];
        $json = json_encode($arr);
        $re = BS::https_request($url,$json);
        $arr = json_decode($re,true);
        $ticket = $arr["ticket"];
        $url = "https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=$ticket";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_NOBODY, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $body = curl_exec($ch);
        curl_close($ch);
        $filename = "img/ticket/".time().".jpg";
        if($file = fopen($filename,"w")){
            if(fwrite($file,$body)){
                return $filename;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    public static function Authcode($url,$QR = false,$logo = false,$errorCorrectionLevel='L',$matrixPointSize = 5){
        //require _ROOT_.'/../app/qrcode/phpqrcode.php';
        QRcode::png($url,$QR, $errorCorrectionLevel, $matrixPointSize,0);
        if ($logo !== FALSE) { 
            $QR = imagecreatefromstring(file_get_contents($QR)); 
            $logo = imagecreatefromstring(file_get_contents($logo)); 
            $QR_width = imagesx($QR);//二维码图片宽度 
            $QR_height = imagesy($QR);//二维码图片高度 
            $logo_width = imagesx($logo);//logo图片宽度 
            $logo_height = imagesy($logo);//logo图片高度 
            $logo_qr_width = $QR_width / 4; 
            $scale = $logo_width/$logo_qr_width; 
            $logo_qr_height = $logo_height/$scale; 
            $from_width = ($QR_width - $logo_qr_width) / 2; 
            imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width,  
            $logo_qr_height, $logo_width, $logo_height); 
        }
        $imgname ="qrcode.png";
        $imgurl = _ROOT_ ."/img/".$imgname;
        imagepng($QR,$imgurl);
        return $imgname;
    }
}