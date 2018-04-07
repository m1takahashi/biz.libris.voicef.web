<?php
namespace System\Controller;

use System\Controller\AbstractController;
use Common\Table\Log\Log;
use Common\Table\Log\LogTable;

class LogController extends AbstractController
{
	private $dbAdapter;
	
	private function init()
	{
		$this->getDBAdapter();
	}

    public function indexAction()
    {
    	$this->init();
		
		$dataStruct = new Log();
		$priorityList = $dataStruct->getPriorityList();
		
    	$lLog = new LogTable($this->dbAdapter);
		$list = $lLog->getList();
		
		
		$this->smarty->priorityList = $priorityList;
		$this->smarty->list			= $list;
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
