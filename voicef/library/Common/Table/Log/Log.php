<?php
namespace Common\Table\Log;

class Log
{
	public $id;
	public $priority;
	public $priorityName;
	public $message;
	public $submitDate;

	private $priorityList =array('0' => 'EMERG',
								 '1' => 'ALERT',
								 '2' => 'CRIT',
								 '3' => 'ERR',
								 '4' => 'WARN',
								 '5' => 'NOTICE',
								 '6' => 'INFO',
								 '7' => 'DEBUG'
								 );

	public function exchangeArray($data)
	{
		$this->id			= (isset($data['id'])) ? $data['id'] : 0;
		$this->priority		= (isset($data['priority'])) ? $data['priority'] : 0;
		$this->priorityName = (isset($data['priorityName'])) ? $data['priorityName'] : '';		 
		$this->message		= (isset($data['message'])) ? $data['message'] : '';
		$this->submitDate 	= (isset($data['submit_date'])) ? $data['submit_date'] : '';
	}
	
	public function exchangeObject($obj)
	{
		$data = array('id'				=> $obj->id,
					  'priority'		=> $obj->priority,
					  'priorityName'	=> $obj->priorityName,
					  'message'			=> $obj->message,
					  'submit_date'		=> $obj->submitDate,
					  );
		return $data;
	}
	
	public function getPriorityList()
	{
		return $this->priorityList;
	}
}
