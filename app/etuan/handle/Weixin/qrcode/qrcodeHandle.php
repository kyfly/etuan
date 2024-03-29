<?php
class QrcodeHandle
{
	public static function getUrl($appid,$appsecret,$scene_id,$id,$type){
        $activity = ['lottery','registration','ticket','vote'];
        $route = ['jiang','baoming','qiang','tou'];
        $token = WS::getToken($appid,$appsecret);
        $url = "https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=$token";
        $arr = ["action_name" => "QR_LIMIT_SCENE" ,"action_info" => ["scene" => [ "scene_id"=> $scene_id]]];
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
        for($i=0;$i<count($activity);$i++){
            if($activity[$i] == $type){
                $filedir = $route[$i];
            }
        }
        $oss = new oss;
        $bucket = QRIMGBUCKET;
        $object = 'etuan/weixin/qrcode/'.$filedir.'/'.$id.'.jpg';
        $options = ['content'=>$body,
                'length'=>strlen($body),
                ALIOSS::OSS_CONTENT_TYPE =>'application/octet-stream'];
        $result = $oss->upload_file_by_content($bucket,$object,$options);
        if($result->status == 200)
        {
            return true;
        }else{
            return false;
        }
    }
    //一般二维码生成，调用该方法是，若$QR为false，则会直接在浏览器中显示图片
    public static function Authcode($url,$QR = false,$logo = false,$errorCorrectionLevel='L',$matrixPointSize = 4){
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
        if(!$imgname){
            $imgname ="qrcode.png";
        }
        $imgurl = $_SERVER['DOCUMENT_ROOT']."/".$imgname;
        imagepng($QR,$imgurl);
        return $imgname;
    }
}