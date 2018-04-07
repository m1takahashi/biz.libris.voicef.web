<?php
namespace System\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use ZSmarty\SmartyModel;

class AbstractController extends AbstractActionController
{
	protected $smarty;

	public function __construct()
	{
	}
	
	public function onDispatch( \Zend\Mvc\MvcEvent $e )
	{
		$action		= $this->params('action');
		$controller	= $this->params('controller');
		$exp = explode('\\', $controller);
		$moduleName		= strtolower($exp[0]);
		$separator = '-';
		$controllerName = strToLower(preg_replace('/([a-z])([A-Z])/', "$1$separator$2", $exp[2]));
		$actionName		= strtolower($action);
		$this->smarty = new SmartyModel;
		$templatePath = "/$moduleName/$controllerName/$actionName.tpl";
		$this->smarty->setTemplate($templatePath);
		return parent::onDispatch( $e );
	}
}