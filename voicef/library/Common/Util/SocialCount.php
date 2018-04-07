<?php
/**
 * SocialCount
 * Twitter,Facebook,Hatenaの共有数を取得
 * @see http://pb-times.jp/P_528ef0e1be9f3
 */
namespace Common\Util;

class SocialCount
{
	public function __construct()
    {
    }		
    
    public function getSocialCount($url)
    {
    	$data = array();
		// @note 現状はTwitterだけでよい
		$data['tw_count']		= $this->getTwitter($url);
		$data['fb_shares']		= 0;
		$data['fb_comments']	= 0;
		$data['hatena_count']	= 0;
//		$data['fb_shares']		= $this->getFacebook($url);
//		$data['fb_comments']	= 0;
//		$data['hatena_count']	= $this->getHatena($url);
		return $data;
	}
	
	// Twitter
	public function getTwitter($url)
	{
		$twit_uri = 'http://urls.api.twitter.com/1/urls/count.json?url=' . rawurlencode($url);
		$json = file_get_contents($twit_uri);
		$result = json_decode($json);
		return (int)$result->{'count'};
	}
	
	// Facebook
	public function getFacebook($url)
	{
		$like_uri = 'http://api.facebook.com/method/fql.query?query=select+total%5Fcount+from+link%5Fstat+where+url%3D%22' . rawurlencode($url).'%22';
		$xml = file_get_contents($like_uri);
		$result = simplexml_load_string($xml);
		return (int)$result->link_stat->total_count;
	}

	// Hatena
	public function getHatena($url)
	{
		$hate_uri = 'http://b.hatena.ne.jp/entry/json/?url=' . rawurlencode($url);
		$json = file_get_contents($hate_uri);
		$result = json_decode($json);
		return (int) $result->count;
	}
}