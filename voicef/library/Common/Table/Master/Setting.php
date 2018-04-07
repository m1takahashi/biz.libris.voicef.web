<?php
namespace Common\Table\Master;

class Setting
{
	public $id;
	public $currentBuild;

	public function exchangeArray($data)
	{
		$this->id			= (isset($data['id'])) ? $data['id'] : 0;
		$this->currentBuild	= (isset($data['current_build'])) ? $data['current_build'] : 0;
	}
	
	public function exchangeObject($obj)
	{
		$data = array('id'				=> $obj->id,
					  'current_build'	=> $obj->currentBuild					  
					  );
		return $data;
	}
}