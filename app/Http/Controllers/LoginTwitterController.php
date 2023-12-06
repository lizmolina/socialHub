<?php

namespace App\Http\Controllers;

use Abraham\TwitterOAuth\TwitterOAuth;

use App\Models\User;

use Illuminate\Http\Request;
class LoginTwitterController extends Controller
{

  private $twitter_api_key;
  private $twitter_api_key_secret;

  public function __construct()
  {
    $this->twitter_api_key_secret = env('TWITTER_SECRET');
    $this->twitter_api_key = env('TWITTER_KEY');
  }

    public function loginTwitter(Request $request)
    {
        $callback=route('k');
        $_twitter_connect = new TwitterOAuth($this->twitter_api_key,$this->twitter_api_key_secret);
        $_twitter_connect->setApiVersion('2');
        $access_token =  $_twitter_connect->oauth("oauth/request_token", ["oauth_callback" => $callback]);
        $route = $_twitter_connect->url('oauth/authorize',['oauth_token'=> $access_token['oauth_token']]);
        return redirect($route);
    }

    public function getToken(Request $request)
    {
        $response= $request->all();

        $oauth_token= $response['oauth_token'];
        $oauth_verifer=  $response['oauth_verifier'];
        $_twitter_connect = new TwitterOAuth($this->twitter_api_key,$this->twitter_api_key_secret,$oauth_token,$oauth_verifer);
        $_twitter_connect->setApiVersion('2');
        $token =  $_twitter_connect->oauth('oauth/access_token',['oauth_verifier'=> $oauth_verifer]);
        $oauth_toke=$token['oauth_token'];
        $oauth_token_secret= $token['oauth_token_secret'];
        $user = User::query()->update(
            ['twitter_oauth_token' => $oauth_toke,
            'twitter_oauth_token_secret' => $oauth_token_secret,
            ]
        );
        return redirect('dashboard-user');
  }

    public function postTweet($oauth_token,$oauth_token_secret,$post){
        $push= new TwitterOAuth($this->twitter_api_key,$this->twitter_api_key_secret,$oauth_token,$oauth_token_secret);
        $push->setApiVersion('2');
        $response = $push->post('tweets', ['text' => $post], true);
       // $push->setTimeouts(10, 15);
        //return redirect()->route('we');
    }

}
