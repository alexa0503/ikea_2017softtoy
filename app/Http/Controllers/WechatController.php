<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper;
use Carbon\Carbon;

class WechatController extends Controller
{
    public function auth(Request $request)
    {
        if (null != $request->get('url')) {
            $request->session()->set('wechat.callback_url', urldecode($request->get('url')));
        } else {
            $request->session()->set('wechat.callback_url', null);
        }
        $app_id = env('WECHAT_APPID');
        $callback_url = $request->getUriForPath('/wechat/callback');
        $state = '';
        $url = 'http://ikea.aitoy.com/wx/api/server/oauth2/snsapi_base.html?url='.$callback_url;

        return redirect($url);
    }
    public function callback(Request $request)
    {
        if ( $request->get('code') == null) {
            return view('errors/503', ['error_msg' => 'error']);
        } else {
            $code = $request->get('code');
            $url = 'http://ikea.aitoy.com/wx/api/server/oauth2/getuser.json?code='.$code;
            $data = json_decode(\App\Helper\HttpClient::get($url));
            if( null != $data ){
                $openid = $data->obj->openid;
                $nick_name = '';
                $head_img = '';
                $country = '';
                $province  = '';
                $city  = '';
                $sex = '';
                $model = \App\WechatUser::where('open_id', $openid);
                if ($model->count() > 0) {
                    $wechat = $model->first();
                    $wechat->updated_at = Carbon::now();
                } else {
                    $wechat = new \App\WechatUser();
                    $wechat->open_id = $openid;
                    $wechat->created_at = Carbon::now();
                    $wechat->ip_address = $request->getClientIp();
                    $wechat->updated_at = null;
                    $wechat->mobile = null;
                    $wechat->name = null;
                }
                $wechat->gender = $sex;
                $wechat->head_img = $head_img;
                $wechat->nick_name = $nick_name;
                $wechat->country = $country;
                $wechat->province = $province;
                $wechat->city = $city;
                $wechat->save();
                $request->session()->set('wechat.id', $wechat->id);
                $request->session()->set('wechat.openid', $openid);
                $request->session()->set('wechat.mobile', $wechat->mobile);
                $request->session()->set('wechat.nickname', $wechat->nick_name);
                $request->session()->set('wechat.headimg', $wechat->head_img);
                return redirect($request->session()->get('wechat.redirect_uri'));
            }
            return view('errors/503', ['error_msg' => 'error']);
        }
        /*
        $app_id = env('WECHAT_APPID');
        $secret = env('WECHAT_SECRET');
        $code = $request->get('code');
        $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$app_id.'&secret='.$secret."&code=$code&grant_type=authorization_code";
        $data = Helper\HttpClient::get($url);
        $token = json_decode($data);
        if (isset($token->errcode) && $token->errcode != 0) {
            return view('errors/503', ['error_msg' => '获取用户信息失败~']);
        }

        $wechat_token = $token->access_token;
        $openid = $token->openid;

        $url = "https://api.weixin.qq.com/sns/userinfo?access_token={$wechat_token}&openid={$openid}";
        $data = Helper\HttpClient::get($url);
        $user_data = json_decode($data);
        if (isset($user_data) && isset($user_data->errcode)) {
            //echo $user_data->message;
            return view('errors/503', ['error_msg' => $user_data->message]);
            //return $user_data->message;
        } else {
            $wechat_user = \App\WechatUser::where('open_id', $openid);
            if ($wechat_user->count() > 0) {
                $wechat = $wechat_user->first();
                $wechat->updated_at = Carbon::now();
            } else {
                $wechat = new \App\WechatUser();
                $wechat->open_id = $openid;
                $wechat->created_at = Carbon::now();
                $wechat->ip_address = $request->getClientIp();
                $wechat->updated_at = null;
            }
            $wechat->gender = $user_data->sex;
            $wechat->head_img = $user_data->headimgurl;
            $wechat->nick_name = json_encode($user_data->nickname);
            $wechat->country = $user_data->country;
            $wechat->province = $user_data->province;
            $wechat->city = $user_data->city;
            //$wechat->options = $options;
            $wechat->save();
            $request->session()->set('wechat.id', $wechat->id);
            $request->session()->set('wechat.openid', $openid);
            $request->session()->set('wechat.nickname', json_decode($wechat->nick_name));
            $request->session()->set('wechat.headimg', $wechat->head_img);

            return redirect($request->session()->get('wechat.redirect_uri'));
        }
        */
    }
}
