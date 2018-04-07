<?php
namespace Common\Util;

use Zend\Http\Client;
use Zend\Http\Request;
use Zend\Dom\Query;

class ImageUtils
{
	/**
	 * OGP情報から、画像URLを取得
	 */
	public static function getImageUrlFromMetaOgp($url)
	{
		mb_language('Japanese');
		$html = mb_convert_encoding(file_get_contents($url), 'UTF-8', "EUC-JP, JIS, UTF-8, eucjp-win, sjis-win");
		if ($html === false) {
			trigger_error("Could not get HTML.");
			return;
		}

		try {
			$dom = new \Zend\Dom\Query(mb_convert_encoding($html, 'HTML-ENTITIES'));
			$meta = $dom->execute('meta');
			foreach ($meta as $d) {
				if (method_exists($d, 'getAttribute') &&
					$d->getAttribute('property') == 'og:image') {
						return $d->getAttribute('content');
				}
			}
		} catch (\Exception $e) {
			// nothing todo
		}
		return "";
	}
	
	/**
	 * URLの存在チェック
	 * @deprecated
	 */
	public static function getHttpRequestByHead($url, $params = array())
	{
		$client = new Client();
		if (isset($params['clientOptions'])) {
			$client->setOptions($params['clientOptions']);
		}
		
		$request = new Request();
		$request->setMethod(Request::METHOD_HEAD);
		$request->setUri($url);
		
		$client->setRequest($request);
		
		try {
			$response = $client->dispatch($request);
		} catch (\Exception $e) {
			throw new \Exception($e->getMessage());
		}
		
		if (isset($params['returnWithClient'])) {
			return array('client'	=> $client,
						 'response'	=> $response
						 );
		}
		return $response;
	}
}

