<?php
namespace System\Controller;

use System\Controller\AbstractController;
use Common\Table\Master\Site\CategoryTable;
use Common\Table\Master\Site AS SiteStruct;
use Common\Table\Master\SiteTable;

class SiteController extends AbstractController
{
	private $dbAdapter;
	private $mSiteCategory;
	private $mSite;
	private $categoryMenu;
	private $siteDispTypeList;
	
	private function init()
	{
		$this->getDBAdapter();
		$this->mSiteCategory	= new CategoryTable($this->dbAdapter);
		$this->mSite			= new SiteTable($this->dbAdapter);
		
		$siteStruct = new SiteStruct();
		$this->siteDispTypeList	= $siteStruct->getDispTypeList();
		$this->categoryMenu	= $this->mSiteCategory->getAsso();

		$this->smarty->categoryMenu		= $this->categoryMenu;
		$this->smarty->siteDispTypeList	= $this->siteDispTypeList;
	}
	
    public function indexAction()
    {
    	$this->init();
		$categoryId = $this->params()->fromQuery('category_id');
		trigger_error("CategoryID : $categoryId");
		$categoryData = $this->mSiteCategory->get($categoryId);
		trigger_error(print_r($categoryData, true));
		
		$list = $this->mSite->getList(array('category_id' => $categoryId));
		for ($i = 0; $i < count($list); $i++) {
			$list[$i]['disp_type_str'] = $this->siteDispTypeList[ $list[$i]['disp_type'] ];	
		}
		
		$this->smarty->categoryId	= $categoryId;
		$this->smarty->categoryData	= $categoryData;
		$this->smarty->list			= $list;
    	return $this->smarty;
    }

	public function addAction()
	{
		$this->init();
		$request = $this->getRequest();
        if ($request->isPost()) {
        	$post = $request->getPost();
			$params = array('category_id'	=> $post['category_id'],
							'title'			=> $post['title'],
							'blog_url'		=> $post['blog_url'],
							'rss_url'		=> $post['rss_url'],
							'disp_type'		=> $post['disp_type']
							);
			$this->mSite->insert($params);
			return $this->redirect()->toUrl('/system/site/index?category_id=' . $post['category_id']);
        }

		// カテゴリーIDを出力
		$data['category_id'] = $this->params()->fromQuery('category_id');
		$this->smarty->data = $data;
		return $this->smarty;
	}
	
	public function editAction()
	{
		$this->init();
		$request = $this->getRequest();
        if ($request->isPost()) {
        	$post = $request->getPost();
			$params = array('category_id'	=> $post['category_id'],
							'title'			=> $post['title'],
							'blog_url'		=> $post['blog_url'],
							'rss_url'		=> $post['rss_url'],
							'disp_type'		=> $post['disp_type']
							);
			trigger_error("ID : " . $post['id']);
			trigger_error(print_r($params, true));
			$this->mSite->update($post['id'], $params);
			return $this->redirect()->toUrl('/system/site/index?category_id=' . $post['category_id']);
        }
		$id = $this->params()->fromQuery('id');
		$data = $this->mSite->get($id);
		$this->smarty->data = $data;
 		return $this->smarty;
	}
	
	/*
	 * deprecated
	public function deleteAction()
	{
		$this->init();
		$request = $this->getRequest();
        if ($request->isPost()) {
        	$post = $request->getPost();
			$this->mChannelTable->delete($post['id']);
			return $this->redirect()->toUrl('/system/feed-channel/index?category_id=' . $post['category_id']);			
		}
		$id = $this->params()->fromQuery('id');
		$data = $this->mChannelTable->get($id);
		$this->smarty->data = $data;
		return $this->smarty;
	}
	 */

	public function settingAction()
	{
		$list = $this->mSite->getList();
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
