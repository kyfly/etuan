<?php
class BS
{
	public static function getRandStr($length)
    {
        $str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $randString = '';
        $len = strlen($str) - 1;
        for ($i = 0; $i < $length; $i++) {
            $num = mt_rand(0, $len);
            $randString .= $str[$num];
        }
        return $randString;
    }
    public static function https_request($url,$data = null){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);	//请求的地址
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 	//对认证证书来源的检查
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); 	//从证书中检查ssl加密算法是否存在
        if (!empty($data)){
            curl_setopt($ch,CURLOPT_POST, 1);		//发送一个常规的post请求
            curl_setopt($ch,CURLOPT_POSTFIELDS, $data);		//post提交的数据
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 	// 获取的信息以文件流的形式返回
        $output = curl_exec($ch);
        if(curl_errno($ch))
        {
            curl_close($ch);
            return false ;
        }
        curl_close($ch);
        return $output;
    }
    public static function createMenu($json,$token){
        $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$token;
        $menu = $json;
        $json = self::https_request($url,$menu);
        if(!$json)
        {
            return "something wrong";
        }
        return true;
    }
    public static function dump($var, $echo = true, $label = null, $strict = true)
        {
            $label = ($label === null) ? '' : rtrim($label) . ' ';
            if (!$strict) {
                if (ini_get('html_errors')) {
                    $output = print_r($var, true);
                    $output = "<pre>" . $label . htmlspecialchars($output, ENT_QUOTES) . "</pre>";
                } else {
                    $output = $label . " : " . print_r($var, true);
                }
            } else {
                ob_start();
                var_dump($var);
                $output = ob_get_clean();
                if (!extension_loaded('xdebug')) {
                    $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
                    $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
                }
            }
            if ($echo) {
                echo($output);
                return null;
            } else
                return $output;
        }
}