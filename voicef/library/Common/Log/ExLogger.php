<?php
namespace Common\Log;

use \Zend\Log\Writer\Db;
use \Zend\Log\Logger;

class ExLogger extends \Zend\Log\Logger
{
	private $tableName = 'l_log';

	private $mapping = array('priority'		=> 'priority',
							 'priorityName'	=> 'priorityName',
							 'message'		=> 'message'
							 );
							 
    public function __construct($dbAdapter)
    {
    	parent::__construct();
    	$writer = new \Zend\Log\Writer\Db($dbAdapter,
    									  $this->tableName,
										  $this->mapping
										  );
		$this->addWriter($writer);
     }	
}

