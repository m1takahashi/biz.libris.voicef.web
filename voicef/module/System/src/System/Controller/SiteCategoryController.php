<?php
namespace System\Controller;

use System\Controller\AbstractController;
use Common\Table\Master\Site\CategoryTable;
use Common\Table\Master\SiteTable;

class SiteCategoryController extends AbstractController
{
	private $dbAdapter;
	private $mSiteCategory;
	private $mSite;

	private function init()
	{
		$this->getDBAdapter();
		$this->mSiteCategory	= new CategoryTable($this->dbAdapter);
		$this->mSite			= new SiteTable($this->dbAdapter);
	}
	
    public function indexAction()
    {
    	$this->init();
		
		$list = $this->mSiteCategory->getList();
		for ($i = 0; $i < count($list); $i++) {
			$tmp = $this->mSite->getCountBySite($list[$i]['category_id']);
			$list[$i]['site_count'] = $tmp['cnt'];
		}
		
		$this->smarty->list = $list;
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
