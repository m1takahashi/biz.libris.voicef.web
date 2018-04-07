<?php
namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
		$eventManager->attach('dispatch', array($this, 'setLayout')); 		
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
	}

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
//                    'Common'        => __DIR__ . '/../../library/Common', // 独自モデルクラス読み込み                    
                ),
            ),
        );
    }
	
    public function setLayout($e)
    {
        $matches    = $e->getRouteMatch();
        $controller = $matches->getParam('controller');
//		trigger_error("Application : $controller");
//		trigger_error("Application : " . __NAMESPACE__);
        if (false === strpos($controller, __NAMESPACE__)) {
            // not a controller from this module
            trigger_error("BP_900");
            return;
        }
        // Set the layout template
        $viewModel = $e->getViewModel();
        $viewModel->setTemplate('application/layout');
    }	
}
