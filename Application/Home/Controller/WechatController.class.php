<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/17
 * Time: 16:48
 */

namespace Home\Controller;

use Common\Common\Controller\BaseController;


class WechatController extends BaseController
{
   public function index()
   {

//       $appid = 'wx783f04c3afcbb7ce';
//       $redirect_uri = urlencode('http://zsgtdc.cn/weixin/index.php/Home/wechat/getUserOpenId');
        //todo 获取到code
//       $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$appid.'&redirect_uri='.$redirect_uri.'&response_type=code&scope=snsapi_base&state=123#wechat_redirect';
//       $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$appid.'&redirect\_uri='.$redirect_uri.'&response\_type=code&scope=snsapi_base&state=123#wechat\_redirect';
//       $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$appid."&redirect\_uri=".$redirect_uri."&response\_type=code&scope=".snsapi_base."&state=123#wechat\_redirect';
//       $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$appid.'&redirect\_uri='.$redirect_uri.'&response\_type=code&scope=snsapi\_base&state=123#wechat\_redirect';
//       header('location:'.$url);

       $appid='wx783f04c3afcbb7ce';
       $redirect_uri = urlencode ( 'http://www.zsgtdc.cn/weixin/index.php/Home/wechat/getUserOpenId' );
       $url ="https://open.weixin.qq.com/connect/oauth2/authorize?appid=$appid&redirect_uri=$redirect_uri&response_type=code&scope=snsapi_base&state=1#wechat_redirect";
      
       header("Location:".$url);
   }

   public function getUserOpenId()
   {
       // todo 获取到网页授权的access_token
        $appid = 'wx783f04c3afcbb7ce';
        $appsecret = '46dc396984eedef3afb7b63ac843c67e';
        $code = $_GET['code'];
        die($code);
        $url = ' https://api.weixin.qq.com/sns/oauth2/access\_token?appid='.$appid.'&secret='.$appsecret.'&code='.$code.'&grant\_type=authorization\_code';
//        $url = ' https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$appsecret.'&code='.$code.'&grant_type=authorization\_code';
       // todo 拉取用户的openid

       $res = $this->http_curl($url, 'get');

       var_dump($res);
   }

   public function http_curl($url = null,$ch = null)
   {
       curl_setopt($ch, CURLOPT_URL,$url);

       curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);

       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);

       $data = curl_exec($ch);

       curl_close($ch);

       echo $data.openid;
   }

}