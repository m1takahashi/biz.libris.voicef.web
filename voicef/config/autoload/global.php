<?php
if (APPLICATION_ENV == 'development') {
// 開発環境
return array(
	'db' => array(
		'driver' => 'Pdo',
		'dsn'		=> 'mysql:dbname=voicef;host=localhost',
		'driver_options' => array(
		PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
		),
	),
	'service_manager'	=> array(
		'factories'	=> array(
//		'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
		'Zend\Db\Adapter\Adapter' => function ($serviceManager) {
			$adapterFactory = new Zend\Db\Adapter\AdapterServiceFactory();
			$adapter = $adapterFactory->createService($serviceManager);
			\Zend\Db\TableGateway\Feature\GlobalAdapterFeature::setStaticAdapter($adapter);
			return $adapter;
         }
         ),
	),
);

} else {
// 運用環境
return array(
	'db' => array(
		'driver' => 'Pdo',
		'dsn'		=> 'mysql:dbname=voicef;host=localhost',
		'driver_options' => array(
		PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
		),
	),
	'service_manager'	=> array(
		'factories'	=> array(
//		'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
		'Zend\Db\Adapter\Adapter' => function ($serviceManager) {
			$adapterFactory = new Zend\Db\Adapter\AdapterServiceFactory();
			$adapter = $adapterFactory->createService($serviceManager);
			\Zend\Db\TableGateway\Feature\GlobalAdapterFeature::setStaticAdapter($adapter);
			return $adapter;
         }
         ),
	),
);
}