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

        $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$appsecret.'&code='.$code.'&grant_type=authorization_code';
//        $url = ' https://api.weixin.qq.com/sns/oauth2/access\_token?appid='.$appid.'&secret='.$appsecret.'&code='.$code.'&grant\_type=authorization\_code';
//        $url = ' https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$appsecret.'&code='.$code.'&grant_type=authorization\_code';
       // todo 拉取用户的openid

       $res = $this->http_curl($url, 'get');

       var_dump($res);
   }

   public function http_curl($url = null, $ch = null)
   {

       $ch = curl_init();
       curl_setopt($ch, CURLOPT_URL, $url);
       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
       curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
       $output = curl_exec($ch);
       curl_close($ch);

       return $output;
   }

   public function getUserDetail()
   {
//       $appid='wx783f04c3afcbb7ce';
//       $redirect_uri = urlencode( 'http://www.zsgtdc.cn/weixin/index.php/Home/wechat/getUserInfo');
//       $url ="https://open.weixin.qq.com/connect/oauth2/authorize?appid=$appid&redirect_uri=$redirect_uri&response_type=code&scope=snsapi_userinf&state=1#wechat_redirect";
//
//       header("Location:".$url);
       $appid='wx783f04c3afcbb7ce';
       $redirect_uri = urlencode ( 'http://www.zsgtdc.cn/weixin/index.php/Home/wechat/getUserInfo' );
       $url ="https://open.weixin.qq.com/connect/oauth2/authorize?appid=$appid&redirect_uri=$redirect_uri&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect";
       header("Location:".$url);
   }

   public function getUserInfo()
   {
//       // todo 获取到网页授权的access_token
//       $appid = 'wx783f04c3afcbb7ce';
//       $appsecret = '46dc396984eedef3afb7b63ac843c67e';
//       $code = $_GET['code'];
//
//       $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$appsecret.'&code='.$code.'&grant_type=authorization_code';
//       // todo 拉取用户的openid
//
//       $red = $this->http_curl($url, 'get');
//
//
//       $usr_info = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$red['access_token'].'&openid='.$red['openid'].'&lang=zh_CN';
//       $re = $this->http_curl($usr_info);
//       var_dump($re);
       $appid = "wx783f04c3afcbb7ce";
       $secret = "46dc396984eedef3afb7b63ac843c67e";
       $code = $_GET["code"];

//第一步:取得openid
       $oauth2Url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$secret&code=$code&grant_type=authorization_code";
       $oauth2 = $this->getJson($oauth2Url);

//第二步:根据全局access_token和openid查询用户信息
       $access_token = $oauth2["access_token"];
       $openid = $oauth2['openid'];
       $get_user_info_url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=$access_token&openid=$openid&lang=zh_CN";
       $userinfo = $this->getJson($get_user_info_url);

//打印用户信息
       print_r($userinfo);
   }
    public function getJson($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        return json_decode($output, true);
    }
}