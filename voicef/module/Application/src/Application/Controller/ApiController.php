<?php
/**
 * API
 * /app/api/actor?syllabary_category=a
 * /app/api/search-keyword?keyword=あい
 */
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Dom\Query;
use Zend\Feed\Reader\Reader;
use Common\Log\ExLogger;
use Common\Table\Master\SettingTable;
use Common\Table\Master\OfficeTable;
use Common\Table\Master\ActorTable;
use Common\Table\Data\Feed\UrlTable;


class ApiController extends AbstractActionController
{
	const STATUS_CODE_SUCCESS				= 0;
	const STATUS_CODE_ERROR					= 1;
	const STATUS_CODE_ERROR_EMPTY			= 201;
	const STATUS_CODE_ERROR_KEYWORD_SHORT	= 202;
	const MESSAGE_SUCCESS					= 'Success';
	const MESSAGE_ERROR						= 'Error';
	const MESSAGE_ERROR_EMPTY				= 'Empty Set.';
	const MESSAGE_ERROR_KEYWORD_SHORT		= 'Keyword must be 2 characters.';

	private $dbAdapter;
	private $mSetting;
	private $mOffice;
	private $mActor;
	private $dFeedUrl;
	private $setting;		// DBに保存している設定
	
	private function init()
	{
		$this->getDBAdapter();
		$this->mSetting	= new SettingTable($this->dbAdapter);
		$this->mOffice	= new OfficeTable($this->dbAdapter);
		$this->mActor	= new ActorTable($this->dbAdapter);
		$this->dFeedUrl = new UrlTable($this->dbAdapter);
		$this->setting = $this->mSetting->get();
	}
	
	/**
	 * グローバル設定取得
	 */
	public function settingAction()
	{
		$this->init();
		echo json_encode(array('status' => 0,
							   'msg'	=> 'maybe success.',
							   'data'	=> array('current_build' => $this->setting['current_build']),
							   ));
		exit();
	}

 	/**
	 * 声優一覧を取得
	 * パラメータとして、五十音（あ、か、さ、た〜）をとる
	 * あ行の一覧を返す
	 */
	public function actorAction()
	{
		$this->init();
        $syllabaryCategory = $this->params()->fromQuery('syllabary_category');
		trigger_error("Syllabary Category : $syllabaryCategory");
		
		// 事務所情報を一括取得
		$office = $this->mOffice->getAsso(null);

		// 声優一覧取得
		$list = $this->mActor->getList(array('syllabary_category' => $syllabaryCategory));
		
		// 事務所名を補完
		$count = count($list);
		for ($i = 0; $i < $count; $i++) {
			$list[$i]['office_name'] = $office[ $list[$i]['office_id'] ]['name'];
		}
		
		echo json_encode(array('status' => 0,
							   'msg'	=> 'maybe success.',
							   'data'	=> $list
							   ));
		exit();		
	}
	
	public function searchKeywordAction()
	{
		$this->init();
        $keyword = $this->params()->fromQuery('keyword');
		
		// 二文字以下の場合はエラー
		if (mb_strlen($keyword) < 2) {
			$this->outputJson(self::STATUS_CODE_ERROR_KEYWORD_SHORT,
							  self::MESSAGE_ERROR_KEYWORD_SHORT,
							  '');
			return;
		}
		
		// 事務所情報を一括取得
		$office = $this->mOffice->getAsso(null);

		// Like　検索
		$list = $this->mActor->searchKeyword($keyword);
		
		// 事務所名を補完
		$count = count($list);
		for ($i = 0; $i < $count; $i++) {
			$list[$i]['office_name'] = $office[ $list[$i]['office_id'] ]['name'];
		}
		
		$this->outputJson(self::STATUS_CODE_SUCCESS,
						  self::MESSAGE_SUCCESS,
						  $list);
		return;
	}
	
	/**
	 * フィードURL取得
	 */
	public function feedUrlAction()
	{
		$this->init();
		$logger = new ExLogger($this->dbAdapter);

		$interval = 60 * 60 * 1; // 更新期間（秒）
		
        $url = $this->params()->fromQuery('url');
		trigger_error("URL : $url");
		
		// DBにあるか確認、あれば、カウントをインクリメントして返す
		$data = $this->dFeedUrl->get($url);
		$data['timestamp'] = strtotime($data['update_date']);
//		trigger_error("Data TS : " . $data['timestamp']);
//		trigger_error("Time : " . time());
		$time = time() - $interval;
//		trigger_error("Interval : " . $interval);
		
		if (!empty($data['rss_url'])) {
			if ($data['timestamp'] > $time) {
				$this->dFeedUrl->insert($data['blog_url'], $data['rss_url'], $data['title']); // カウントアップ
				$this->outputJson(self::STATUS_CODE_SUCCESS, self::MESSAGE_SUCCESS, $data);
			}
		}

		// 実際にアクセスして確認
		$rssUrl = '';
		//$html = file_get_contents($url);
		mb_language('Japanese');
		$html = mb_convert_encoding(file_get_contents($url), 'UTF-8', "EUC-JP, JIS, UTF-8, eucjp-win, sjis-win");
		if ($html === false) {
			trigger_error("ERROR : " . self::MESSAGE_ERROR);
			$this->outputJson(self::STATUS_CODE_ERROR, self::MESSAGE_ERROR, null);
		}

		// RSS URL
		$dom = new Query(mb_convert_encoding($html, 'HTML-ENTITIES'));
		$results = $dom->execute('link');
		if (!empty($results)) {
			foreach ($results as $result) {
				if (preg_match('/rdf|rss|atom/i', $result->getAttribute('type'))) {
					$rssUrl = $result->getAttribute('href');
					trigger_error("RSS URL : $rssUrl");
					break; // 一つとれれば十分
				}
			}
		}
		
		// フィード情報で、Title,URLを保管
		try {
			$feed = Reader::import($rssUrl);
		} catch (Zend\Feed\Reader\Exception\RuntimeException $e) {
			$logger->err($e->getMessage());
			continue;
		}
		
		$title = $feed->getTitle();
		if ($feed->getLink()) {
			$url = $feed->getLink();
		}
		$logger->debug("Title : $title");
		$logger->debug("URL   : $url");

		// タイトルが空の場合、HTMLをパースして取得する
		if (empty($title)) {
			$logger->debug("フィード情報から、タイトルが取得できませんでした。");
			
			$results = $dom->execute('title');
			if (!empty($results)) {
				foreach ($results as $result) {
					$title = $result->nodeValue;
				}
			}
		}

		$logger->debug("最終的なタイトル : $title");

		// データが取得できなかった		
		if (empty($url) || empty($rssUrl) || empty($title)) {
			$this->outputJson(self::STATUS_CODE_ERROR_EMPTY, self::MESSAGE_ERROR_EMPTY, null);
		}

		$params = array('blog_url'	=> $url,
						'rss_url'	=> $rssUrl,
						'title'		=> $title
						);
		trigger_error(print_r($params, true));
		$this->dFeedUrl->insert($params['blog_url'], $params['rss_url'], $params['title']);
		$this->outputJson(self::STATUS_CODE_SUCCESS, self::MESSAGE_SUCCESS, $params);
	}	

	/**
	 * JSON出力
	 */
	private function outputJson($status, $message, $data)
	{
		echo json_encode(array('status' => $status,
							   'msg'	=> $message,
							   'data'	=> $data
							   ));
		exit();		
	}

	private function getDBAdapter()
	{
		if (!$this->dbAdapter) {
			$sm = $this->getServiceLocator();
			$this->dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
		}
		return $this->dbAdapter;
	}
}
