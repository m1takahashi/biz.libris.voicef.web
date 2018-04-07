<?php
/**
 * 基底クラス
 */
namespace Application\Controller;

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
//		trigger_error("Exp[2] : " . $exp[2]);
		$moduleName		= strtolower($exp[0]);
		// StatsRequest -> stats-request
		$separator = '-';
		$controllerName = strToLower(preg_replace('/([a-z])([A-Z])/', "$1$separator$2", $exp[2]));
		$actionName		= strtolower($action);
//		trigger_error("ModuleName     : $moduleName");		
//		trigger_error("ControllerName : $controllerName");
//		trigger_error("ActionName     : $actionName");			
		// Smarty設定
		$this->smarty = new SmartyModel;
		$templatePath = "/$moduleName/$controllerName/$actionName.tpl";
//		trigger_error("Template Path : $templatePath");
		$this->smarty->setTemplate($templatePath);
		return parent::onDispatch( $e );
	}
}