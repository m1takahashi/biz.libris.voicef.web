<?php
namespace System\Controller;

use System\Controller\AbstractController;
use Common\Table\Master\SettingTable;

class IndexController extends AbstractController
{
	private $dbAdapter;
	private $mSetting;
	
	private function init()
	{
		$this->getDBAdapter();
		$this->mSetting = new SettingTable($this->dbAdapter);
	}

	/**
	 * ドキュメント表示
	 */
    public function indexAction()
    {
    	$this->init();
    	$data = $this->mSetting->get();
		$this->smarty->data = $data;
		return $this->smarty;
    }

	public function editAction()
	{
		$this->init();
		$request = $this->getRequest();
        if ($request->isPost()) {
        	$post = $request->getPost();
			$params = array('current_build'	=> $post['current_build']);
			$this->mSetting->update($params);
        }
        return $this->redirect()->toUrl('/system/index/index');
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
