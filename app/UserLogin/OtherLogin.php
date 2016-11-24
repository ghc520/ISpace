<?php
namespace App\UserLogin;
use App\User;
use Overtrue\Socialite\SocialiteManager;
class OtherLogin
{
    //github登录
    public function githubLogin($config){
        $socialite = new SocialiteManager($config);
        $githubUser = $socialite->driver('github')->user();//user就可以拿到igthub的公共信息

        //第一次用户登录
        $loginUser = User::where('social_type', 'github')->where('social_id', $githubUser->getId())->first();
        //如果没有查到这个用户 重定向到首页
        if (!is_null($loginUser)) {
            \Auth::loginUsingId($loginUser->id);
            return redirect('/');
        }
        $user = [
            'name' => $githubUser->getNickName(),
            'email' => $githubUser->getEmail(),
            'password' => bcrypt(str_random(16)),
            'social_type' => 'github',
            'social_id' => $githubUser->getId()
        ];
        $data = [
            'is_confirmed' => 1,
            'confirm_code' => str_random(48),
            'avatar' => $githubUser->getAvatar(),
        ];
        $newUser = User::create(array_merge($user, $data));
        \Auth::loginUsingId($newUser->id);
        return redirect('/');
    }

    //qq登录
    public function qqLogin(){

    }

    //微信登录
    public  function weixinLogin(){

    }

    //微博登录
    public function weiboLogin(){
        $socialite = new SocialiteManager($this->config);
        $weiboUser = $socialite->driver('weibo')->user();//user就可以拿到igthub的公共信息

        //第一次用户登录
        $loginUser = User::where('social_type', 'weibo')->where('social_id', $weiboUser->getId())->first();
        //如果没有查到这个用户 重定向到首页
        if (!is_null($loginUser)) {
            \Auth::loginUsingId($loginUser->id);
            return redirect('/');
        }
        $user = [
            'name' => $weiboUser->getNickName(),
            'email' => $weiboUser->getEmail(),
            'password' => bcrypt(str_random(16)),
            'social_type' => 'weibo',
            'social_id' => $weiboUser->getId()
        ];
        $data = [
            'is_confirmed' => 1,
            'confirm_code' => str_random(48),
            'avatar' => $weiboUser->getAvatar(),
        ];
        $newUser = User::create(array_merge($user, $data));
        \Auth::loginUsingId($newUser->id);
        return redirect('/');
    }
}