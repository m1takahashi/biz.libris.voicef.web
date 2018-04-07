<?php
namespace System\Controller;

use System\Controller\AbstractController;
use Common\Table\Master\Site\CategoryTable;
use Common\Table\Master\SiteTable;
use Common\Table\Data\Feed\EntryTable;

class FeedEntryController extends AbstractController
{
	private $dbAdapter;
	private $mSite;
	private $dFeedEntry;
	
	private function init()
	{
		$this->getDBAdapter();
		$this->mSite			= new SiteTable($this->dbAdapter);
		$this->dFeedEntry		= new EntryTable($this->dbAdapter);
	}
	
    public function indexAction()
    {
    	$this->init();
		
		$type = $this->params()->fromQuery('type');
		
		$limit = 50; // 50件取得
		
		// Apiと同じ（Offset方式ではなく、Page方式とする）		
		$p = $this->params()->fromQuery('p');
		if (empty($p)) {
			$p = 1;
		}
		$offset = ($p - 1) * $limit;
		$page = array('current' => $p,
					  'next'	=> $p + 1,
					  'prev'	=> $p - 1
					  );

		switch ($type) {
			case 'new':
				$order	= EntryTable::LIST_ORDER_NEW;
				$term	= EntryTable::LIST_TERM_WEEKLY;
				break;
			case 'daily':
				$order	= EntryTable::LIST_ORDER_TWITTER;
				$term	= EntryTable::LIST_TERM_DAILY;
				break;
			case 'weekly':
				$order	= EntryTable::LIST_ORDER_TWITTER;
				$term	= EntryTable::LIST_TERM_WEEKLY;
				break;
			case 'monthly':
				$order	= EntryTable::LIST_ORDER_TWITTER;
				$term	= EntryTable::LIST_TERM_MONTHLY;
				break;
			default:
				exit('パラメータが不正です。');
				break;
		}
		
		// サイト情報（全件）
		$siteData = $this->mSite->getAsso(null);
		
		// 表示フラグがついているもののみ
		$tmp = $this->mSite->getList(array('system_select' => '1'));
		$siteIds = array();
		for ($i = 0; $i < count($tmp); $i++) {
			$siteIds[] = $tmp[$i]['id'];
		}

		// 記事一覧取
		$list = $this->dFeedEntry->getList($siteIds, $order, $term, $offset, $limit);
		for ($i = 0; $i < count($list); $i++) {
			$list[$i]['site_title']		= $siteData[ $list[$i]['site_id'] ]['title'];
			$list[$i]['site_blog_url']	= $siteData[ $list[$i]['site_id'] ]['blog_url'];
		}

		$this->smarty->type	= $type;
		$this->smarty->list	= $list;
		$this->smarty->page	= $page;
    	return $this->smarty;
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
